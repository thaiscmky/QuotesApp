<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>eQuote Prototype</title>
</head>
<body>
<div class="container-fluid" id="main">
    <div class="container">
        <div class="col main pt-5 mt-3 ml-3">
            <div class="card" id="equote_result">
                <div class="card-body">

                </div>
            </div>
            <div class="card" id="equote_demo">
                <div class="card-header">
                    <strong>eQuote</strong> <span id="step">Create Quote Request</span> <span class="badge badge-success">Ready</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Basic Information</h5>
                    <p class="card-text"></p>
                    <form id="step1">
                        <fieldset id="quote-info" class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="quoteName">Quote Name</label>
                                    <input type="text" class="form-control" id="quoteName" name="quoteName" value="Foobar" required>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset id="product-info" class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="customerId">Magento Customer ID</label>
                                    <input type="text" class="form-control" id="customerId" name="customerId" value="2041" required>
                                </div>
                            </div>
                            <div class="form-row" id="products">
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset id="shipping-info" class="form-group">
                            <h5 class="card-title">Shipping Address</h5>
                            <p class="card-text">* Required to obtain shipping rates.</p>
                            <div class="form-group">
                                <label for="shippingstreet1">Street 1</label>
                                <input type="text" class="form-control" id="shippingaddress1" name="shippingaddress1" value="2130 West Sam Houston Pkwy N">
                            </div>
                            <div class="form-group">
                                <label for="shippingstreet2">Street 2</label>
                                <input type="text" class="form-control" id="shippingstreet2" name="shippingstreet2" placeholder="">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="shippingcity">City</label>
                                    <input type="text" class="form-control" id="shippingcity" name="shippingcity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="shippingstate">State</label>
                                    <select id="shippingstate" name="shippingstate" class="form-control">
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX" selected>Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="shippingzip">Zip</label>
                                    <input type="text" class="form-control" id="shippingzip" name="shippingzip">
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset id="shipping-rates" class="form-group">
                            <h5 class="card-title">Shipping Rates</h5>
                            <p class="card-text">* Shipping estimate Endpoint requires a <strong>cartId</strong>. Shipping carriers can be selected once quote is created.</p>
                            <small class="form-text text-muted">See the function <em>retrieveShippingRates()</em> for details</small>
                            <div id="carriers"><!--available after cart is created--></div>
                        </fieldset>
                        <hr>
                        <fieldset id="misc" class="form-group">
                            <h5 class="card-title">Additional Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="quoteComment">Quote Comments</label>
                                    <textarea class="form-control" id="quoteComment" name="quoteComment" rows="3"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <button type="submit" class="btn btn-primary" id="createnegotiablequote">Create Negotiable Quote</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<br>
<br>
<br>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<script>

    let customerId = false;
    let items = false;
    let address = false;
    let requestResults = {};

    $(document).ready(function () {
        createProductField(0);
        listenToEvents();
    });

    function listenToEvents(){
        //Verify a SKU has been entered for the current product before adding another product to quote
        $('button[id^="addproduct-"]').on('click', function(e){
            let rowid = parseInt(this.id.substr(this.id.indexOf('-')+1) - 1);
            if(!$(this).parents('#products').find('#productsku-'+rowid).val())
                alert('Please enter a product first before adding another.');
            else
                createProductField(rowid+1);
        });

        //If address is filled, save data for next step with shipping rates
        allowCalcShipping();

        //Initiate quote request on submit
        $("#step1").submit(function( event ) {
            event.preventDefault();
            var formdata = $(this).serializeArray();
            var request = {};
            let products = {};
            products.productskus = [];
            products.productqtys = [];
            products.productprices = [];
            formdata.forEach(field => {
                switch(field.name){
                    case 'productsku':
                        products.productskus.push(field.value);
                        break;
                    case 'productqty':
                        products.productqtys.push(field.value);
                        break;
                    case 'productprice':
                        products.productprices.push(field.value);
                        break;
                    default:
                        request[field.name] = field.value;
                }
            });
            let filteredRequest = {
                quoteName: request.quoteName,
                quoteComment: request.quoteComment,
                customerId: request.customerId,
                cartItems: products.productskus.map( function(item, index){
                    return { sku: item, qty: products.productqtys[index], price: products.productprices[index] }
                }),
                address: address
            };

            initiateNegotiableQuoteRequest(filteredRequest)
        });

    }

    function allowCalcShipping(){
        let filled = 0;
        $("#shipping-info input:text").on('blur', () =>{
            filled = $("#shipping-info input:text").filter(function() {
                return $.trim(this.value) != "";
            });
            let optional = $("#shipping-info input#shippingstreet2:text").val();
            if( (filled.length >= 3 && optional === '') || filled.length >= 4){
                let formaddress = $(filled).serializeArray();
                addressObj = {};
                formaddress.forEach(field => addressObj[field.name] = field.value);
                addressObj.shippingstatecode = $("#shipping-info #shippingstate").val();
                requestObj = {
                    address: addressObj.shippingaddress1,
                    region_code: addressObj.shippingstatecode,
                    country_id: "US",
                    street: [addressObj.shippingaddress1],
                    postcode: addressObj.shippingzip,
                    city: addressObj.shippingcity
                };
                console.log(`Address information saved for shipping rates after quote creation:
                ${JSON.stringify(requestObj)}`);
                address = requestObj;
            }
        });
    }

    function formatShippingRate(carriers){
        let html = '';
        $.each(carriers, (i, carrier) => {
            html += `
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="carrier" id="${carrier.carrier_code}" value="${carrier.carrier_code}">
                    ${carrier_title} $${carrier.price_excl_tax} ($${carrier.price_inc_tax} with taxes)
                </label>
            `;
        });
        html = `<div class="form-group">${html}</div>`;
        return html;
    }

    function createProductField(id){
        let html = '';
        html += `<div class="form-group col-4">
                    <label for="productsku-${id}">Product SKU</label>
                    <input type="text" class="form-control" id="productsku-${id}" name="productsku" required>
                    <small id="productpriceHelp" class="form-text text-muted">Original price of the product does not change before a negotiable is created.</small>
                </div>`;
        html += `<div class="form-group col-2">
                    <label for="productprice-${id}">Price</label>
                    <input type="text" class="form-control" id="productprice-1" name="productprice">
                </div>`;
        html += `<div class="form-group col-1">
                    <label for="productqty">Quantity</label>
                    <input type="text" class="form-control" id="productqty-${id}" name="productqty" value="1" required>
                </div>`;
        html += `<div class="form-group col d-flex align-items-center mb-4">
                    <button type="button" class="btn btn-sm" class="addproduct" id="addproduct-${id + 1}">Add another product</button>
                </div>`;
        $("#products").append(html);
    }

    function initiateNegotiableQuoteRequest(request){
        console.log(request);
        $.ajax({
            url: `./step_one.php`,
            type: 'post',
            data: request,
            dataType: 'json',
            context: this
        }).done(result => console.log(result))
            .catch(err => err.responseText);
    }

</script>
</body>
</html>



