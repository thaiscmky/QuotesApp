require('dotenv').config();
var express = require("express");
var bodyParser = require("body-parser");

var app = express();
var PORT = 3000;

// Sets up the Express app to handle data parsing
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(express.static('public'));

var exphbs = require("express-handlebars");

app.engine("handlebars", exphbs({ defaultLayout: "main" }));
app.set("view engine", "handlebars");

var mysql = require("mysql");

var connection = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
});

connection.connect(function(err) {
  if (err) {
    console.error("error connecting: " + err.stack);
    return;
  }
  console.log("connected as id " + connection.threadId);
});

// Express and MySQL code
app.get('/', getAllQuotes);
app.get('/:id', viewQuote);
app.post('/api/quotes', addQuote);
app.put('/api/quotes/:id', updateQuote);
app.delete('/api/quotes/:id', deleteQuote);

function deleteQuote(req, res){
    connection.query("DELETE FROM quotes WHERE ?", {id: req.params.id}, function(err, results){
        if(err)
            return res.status(500).send("Something went wrong editing your quote").end();
        res.status(200).send("Delete successful").end();
    });
}

function updateQuote(req, res){
    connection.query("UPDATE quotes SET ? WHERE ?", [{quote: req.body.quote, author: req.body.author}, {id: req.params.id}],
    function(err, results){
        if(err)
            return res.status(500).send("Something went wrong editing your quote").end();
        res.status(200).send("Edit successful").end();
    });
}

function addQuote(req, res){
    connection.query("INSERT INTO quotes SET ?", {author: req.body.author, quote: req.body.quote},
    function(err, results){
        if(err)
            return res.status(500).send("Something went wrong submitting your quote").end();
        res.json(results.insertId);
    });
}
function viewQuote(req, res){
    connection.query("SELECT * FROM quotes WHERE id = ?", [req.params.id], function(err, results){
        if(err)
            return res.status(500).send('Something went wrong trying to get your quote.').end();
        res.render('single-quote', results[0]);
    });
}


function getAllQuotes(req, res){
    connection.query("SELECT * FROM quotes;", function(err, results){
       if(err)
           return res.status(500).send('Something went wrong with your request.').end();
       res.render('index', {quotes: results});
    });
}

// Start our server so that it can begin listening to client requests.
app.listen(PORT, function() {
  // Log (server-side) when our server has started
  console.log("Server listening on: http://localhost:" + PORT);
});
