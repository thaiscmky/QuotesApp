require("dotenv").config();
var mysql = require("mysql");

var connection = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD
});

var seedArray = [
    ['Know your "why" in any of your endeavors. That will push you through any wall you hit.', 'Albert Bahia'],
    ['In any moment of decision, the best thing you can do is the right thing, the next best thing is the wrong thing, and the worst thing you can do is nothing.', "Theodore Roosevelt"],
    ['Never leave home without your cardigan.', "Owens O'Brien"],
    ['Give me fuel, Give me fire, Give me that which I desire, Ooh!', "Nate Tuvera"],
    ["TiK ToK, on the clock; But the party don't stop no; Whoa-oh oh oh; Whoa-oh oh oh; Don't stop, make it pop; DJ, blow my speakers up", "Michael Stearne"],
    ["They told him don't you ever come around here; Don't want to see your face, you better disappear; The fire's in their eyes and their words are really clear; So beat it, just beat it", "Dan Orrico"],
    ["Sup bro?", "Ruby Pradhan"]
];

connection.query("CREATE DATABASE IF NOT EXISTS ??",[process.env.DB_NAME], function(error){
   if(error) throw error;
   console.log('Database successfully created.');
   var tb_args = ["id int NOT NULL AUTO_INCREMENT",
       "author varchar(255) NOT NULL",
       "quote TEXT NOT NULL",
       "PRIMARY KEY (id)"];
   connection.query(`CREATE TABLE IF NOT EXISTS ??( ${tb_args.join(',')} )`,
       [process.env.DB_NAME + '.quotes'],
   function(error){
       if(error) throw error;
       console.log('Table created successfully');
       seedArray.forEach(function(seed, index){
          connection.query("INSERT INTO ??(quote,author) VALUES(?, ?)", [process.env.DB_NAME + '.quotes'
            ].concat(seed)
          , function(error){
              if(error) throw error;
              if (index === seedArray.length - 1){
                  console.log('seeds inserted');
                  process.exit(0);
              }
          });
       });

   });
});