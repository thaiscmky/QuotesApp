<?php
session_start();
//API call responses are stored in this variable
$_SESSION['api_info'] = [];
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
    <style>
        #equote_result {
            margin-top: 25px;
            background-color: #FFFFCC;
            border: 2px dashed #FF6666;
        }
        #equote_result pre {
            font-size: 87.5%;
            color: #212529;
            margin: 10px -20px -15px 5px;
            white-space: pre-wrap;
            overflow-y: scroll;
            height: 200px;
        }
        .table-responsive.products { font-size: 12px;}
        .equote_demo
        {
            display:none;
        }
    </style>
    <title>eQuote Prototype</title>
</head>
<body>
<div class="container-fluid" id="main">
    <div class="container">
        <div class="col main pt-5 mt-3 ml-3">
            <div class="card equote_demo">
                <div class="card-header">
                    <strong>eQuote</strong> <span id="step">Create customer order</span> <span class="badge badge-success">Ready</span>
                </div>
                <div class="card-body">
                    <?php include_once 'step1form.php'; ?>
                </div>
            </div>

            <div class="card equote_demo mt-5">
                <div class="card-header">
                    <strong>eQuote</strong> <span id="step">Add products to order</span> <span class="badge badge-success">Ready</span>
                </div>
                <div class="card-body">
                    <?php include_once 'step2form.php'; ?>
                </div>
            </div>

            <div class="card equote_demo mt-5">
                <div class="card-header">
                    <strong>eQuote</strong> <span id="step">Set shipping method</span> <span class="badge badge-success">Ready</span>
                </div>
                <div class="card-body">
                    <?php include_once 'step3form.php'; ?>
                </div>
            </div>

            <div class="card equote_demo mt-5">
                <div class="card-header">
                    <strong>eQuote</strong> <span id="step">Convert order to quote</span> <span class="badge badge-success">Ready</span>
                </div>
                <div class="card-body">
                    <?php include_once 'step4form.php'; ?>
                </div>
            </div>

            <div class="negotiable_quote_created card-body">
                <pre></pre>
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

    let address = false;
    let request = {};
    let requestResults = {};

    $(document).ready(function () {
        $('#step1').parents('.equote_demo').show();
        createProductField(0);
        listenToEvents();
    });

    function listenToEvents(){
        //If address is filled, save data for next step with shipping rates
        allowCalcShipping();
        //Initiate quote request on submit
        createCustomerCart();
        //Add items to quote request
        addProductsToCart();
        //Set cart's shipping method
        setShippingMethod();
        //Request negotiable quote
        requestNegotiableQuote();

        /**
         * PROTOTYPE UI ONLY; NOT PART OF API CALLS:
         **/
        //Verify a SKU has been entered for the current product before adding another product to quote
        //API call takes one product at a time
        validateAddProductToCart();
        //Allow for skipping shipping method prior to negotiable quote creation
        skipShipping();

    }

    function setStepMessage(message, classToggle){
        $('.equote_demo span.badge').text(message);
        $('.equote_demo span.badge').toggleClass(classToggle);
    }

    /**
     * Start Cart Creation methods
     * */
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
                let requestObj = {
                    street: optional.length ?
                        [addressObj.shippingaddress1, optional] : [addressObj.shippingaddress1],
                    region_code: addressObj.shippingstatecode,
                    country_id: "US",
                    postcode: addressObj.shippingzip,
                    city: addressObj.shippingcity
                };
                console.log(`Address information saved for shipping rates after quote creation:
                ${JSON.stringify(requestObj)}`);
                address = requestObj;
            }
        });
    }

    function createCustomerCart(){
        $("#step1").submit(function( event ) {
            event.preventDefault();
            console.log('Creating cart...');
            var formdata = $(this).serializeArray();
            formdata.forEach(field => {
                request[field.name] = field.value;
            });
            let filteredRequest = { customerId: request.customerId };
            if(address) filteredRequest.address = address;
            request = filteredRequest;

            setStepMessage('Creating customer cart...', 'badge-success badge-warning');

            $.ajax({
                url: `./stpone_createcart.php`,
                type: 'post',
                data: request,
                dataType: 'json',
                context: this
            }).done(result => {
                console.log('Result:');
                console.log(result);
                $('#step1').parents('.equote_demo').hide();
                $('#step2').parents('.equote_demo').show();
                $('.equote_demo span.badge').text('Ready');
                setStepMessage('Ready', 'badge-warning badge-success');
                $('.equote_demo #step').text('Add products to cart quote');
                $('.equote_demo .quoteId').text(result.cartId);
                $('.equote_demo .customerId').text(result.customerId);
                if(address) {
                    $('.equote_demo .customerShipping').html(
                        `<br>${address.street.join(',')}<br> ${address.city}, ${address.region_code} ${address.postcode} - ${address.country_id}`
                    );

                }

            }).catch(err => console.log(err.responseText));
        });
    }

    /**
     * End Cart Creation methods
     **/

    /**
     * Start Add Products to Cart methods
     **/

    function validateAddProductToCart(){
        $('button[id^="addproduct-"]').on('click', function(e){
            let rowid = parseInt(this.id.substr(this.id.indexOf('-')+1) - 1);
            if(!$(this).parents('#products').find('#productsku-'+rowid).val())
                alert('Please enter a product first before adding another.');
            else
                createProductField(rowid+1);
        });
    }

    function createProductField(id){
        let html = '';
        html += `<div class="form-group col">
                    <label for="productsku-${id}">Product SKU</label>
                    <input type="text" class="form-control" id="productsku-${id}" name="productsku" required>
                </div>`;
        html += `<div class="form-group col-2">
                    <label for="productqty">Quantity</label>
                    <input type="text" class="form-control" id="productqty-${id}" name="productqty" value="1" required>
                </div>`;
        html += `<div class="form-group col d-flex align-items-center mt-4">
                    <button type="button" class="btn btn-sm" class="addproduct" id="addproduct-${id + 1}">Add another product</button>
                </div>`;
        $("#products").append(html);
    }

    function formatShippingRate(carriers){
        let html = '';
        $.each(carriers, (i, carrier) => {
            html += `
                <div class="form-group col">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="carrier" id="${carrier.carrier_code}" value="${carrier.carrier_code}">
                    ${carrier.carrier_title} $${carrier.price_excl_tax} ($${carrier.price_incl_tax} with taxes)
                </label>
                </div>
            `;
        });
        html = `<div class="form-group">${html}</div>`;
        return html;
    }

    function formatAddedProducts(products){
        let html = '';
        $.each(products, (i, product) => {
            html+=`<tr>
                      <th scope="row">${product.item_id}</th>
                      <td>${product.sku}</td>
                      <td>${product.qty}</td>
                      <td>${product.name}</td>
                    </tr>`;
        });
        html = `<div class="table-responsive products"><table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col">SKU</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${html}
                  </tbody>
                </table></div>`;
        return html;
    }

    function addProductsToCart(){
        $("#step2").submit(function( event ) {
            event.preventDefault();
            console.log('Adding products...');
            var formdata = $(this).serializeArray();
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
                    default:
                        request[field.name] = field.value;
                }
            });
            let filteredRequest = {
                quoteName: request.quoteName,
                quoteComment: request.quoteComment,
                quotePrice: request.quoteNegotiatedPrice,
                customerId: request.customerId,
                cartItems: products.productskus.map( function(item, index){
                    return { sku: item, qty: products.productqtys[index], price: products.productprices[index] }
                })
            };

            if(address) filteredRequest.address = address;

            request = filteredRequest;

            setStepMessage('Adding products to cart...', 'badge-success badge-warning');

            $.ajax({
                url: `./stptwo_addproducts.php`,
                type: 'post',
                data: request,
                dataType: 'json',
                context: this
            }).done(result => {
                console.log('Result:');
                console.log(result);
                $('#step2').parents('.equote_demo').hide();
                $('#step3').parents('.equote_demo').show();
                $('.equote_demo span.badge').text('Ready');
                setStepMessage('Ready', 'badge-warning badge-success');
                $('.equote_demo #step').text('Set shipping information');
                $('.equote_demo .negotiableId').text(result.cartId);
                $('.equote_demo .negotiableProds').html(formatAddedProducts(result['itemsAdded']));
                $('.equote_demo .negotiablePrice').text(request.quotePrice);
                $('.equote_demo .negotiablePriceType').text(`(3) Set a proposed price for the entire quote`);
                $('.equote_demo .customerId').text(result.customerId);
                if(address) {
                    $('.equote_demo .customerShipping').html(
                        `<br>${address.street.join(',')}<br> ${address.city}, ${address.region_code} ${address.postcode} - ${address.country_id}`
                    );
                    if(typeof result['shippingCarriers'] !== 'undefined' && result['shippingCarriers'] !== null)
                        $('#negotiable-carriers').html(formatShippingRate(result['shippingCarriers']));
                }

            }).catch(err => console.log(err.responseText));
        });
    }
    /**
     * End Add Products to Cart methods
     **/

    /**
     * Start Set Shipping methods
     **/
    function skipShipping() {
        $('#skipshippingmethod').on('click', function(){
            $('.equote_demo #step').text('Request Negotiable Quote');
            $('#step3').parents('.equote_demo').hide();
            $('#step4').parents('.equote_demo').show();
        });
    }

    function setShippingMethod(){
        $('#negotiable-carriers').on('click', 'input[type="radio"]',function(){
            $('#setshippingmethod').prop('disabled', false);
        });

        $("#step3").submit(function( event ) {
            event.preventDefault();
            console.log('Setting order shipping method...');
            var formdata = $(this).serializeArray();
            formdata.forEach(field => {
                request[field.name] = field.value;
            });

            setStepMessage('Setting shipping information...', 'badge-success badge-warning');

            $.ajax({
                url: `./stpthree_settingshipping.php`,
                type: 'post',
                data: request,
                dataType: 'json',
                context: this
            }).done(result => {
                console.log('Result:');
                console.log(result);
                $('#step3').parents('.equote_demo').hide();
                $('#step4').parents('.equote_demo').show();
                $('.equote_demo span.badge').text('Ready');
                setStepMessage('Ready', 'badge-warning badge-success');
                $('.equote_demo #step').text('Request Negotiable Quote');
                $('.equote_demo .negotiableId').text(result.cartId);
                $('.equote_demo .negotiableName').text(request.quoteName);
                $('.equote_demo .negotiableComment').text(request.quoteComment);
                $('.equote_demo .negotiableProds').html(formatAddedProducts(result['itemsAdded']));
                $('.equote_demo .negotiablePrice').text(request.quotePrice);
                $('.equote_demo .negotiablePriceType').text(`(3) Set a proposed price for the entire quote`);
                $('.equote_demo .negotiableShipping').text(`${result.shippingCarrierInfo.carrier_title}: ${result.shippingCarrierInfo.method_title}`);
                $('.equote_demo .customerId').text(result.customerId);
                if(address) {
                    $('.equote_demo .customerShipping').html(
                        `<br>${address.street.join(',')}<br> ${address.city}, ${address.region_code} ${address.postcode} - ${address.country_id}`
                    );

                }
                $('#cartquote_payload pre').text(JSON.stringify(result.shippingInfoResponse, null, "\t"));

            }).catch(err => console.log(err.responseText));
        });
    }
    /**
     * End Set Shipping methods
     **/

    /**
     * Start of Request Negotiable Quote methods
     **/
    function requestNegotiableQuote(){
        $("#step4").submit(function( event ) {
            event.preventDefault();
            console.log('Creating Negotiable Quote...');
            setStepMessage('Requesting negotiable quote...', 'badge-success badge-warning');

            $.ajax({
                url: `./stpfour_requestnquote.php`,
                type: 'post',
                data: request,
                dataType: 'json',
                context: this
            }).done(result => {
                console.log('Created');
                $('#step4').parents('.equote_demo').hide();
                $('.equote_demo span.badge').text('Ready');
                setStepMessage('Ready', 'badge-warning badge-success');
                $('.negotiable_quote_created').prepend('<h2>Negotiable Quote Created</h2>');
                $('.negotiable_quote_created pre').text(JSON.stringify(result, null, "\t"));


            }).catch(err => console.log(err.responseText));
        });
    }
    /**
     * End of Request Negotiable Quote methods
     **/

    /**
     * Start Update Negotiable Quote methods
     **/
    <!-- future implementation -->
    /**
     * Start Update Negotiable Quote methods
     **/

</script>
</body>
</html>



