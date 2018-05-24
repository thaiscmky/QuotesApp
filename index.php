<?php
/**
 * Created by PhpStorm.
 * User: thais.cailet
 * Date: 5/23/18
 * Time: 2:27 PM
 */
$consumerKey = "j363fhnuwcrcac5rao08222xr0vyhsq0";
$consumerSecret = "0fvj1a86iigx6p21mcce9poa8u4f7qn9";
$accessToken = "i5winc5f73ysay2opskw8y7igw9tsv18";
$accessTokenSecret = "n0pmm2bcgcgem26qya0jmrbk807x6o8g";

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
                <div class="card">
                    <div class="card-header">
                        eQuote <span id="step">Step 1</span> <span class="badge badge-success">Ready</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Some Title</h5>
                        <p class="card-text">Some content</p>
                        <form id="step1">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Magento Customer ID</label>
                                    <input type="text" class="form-control" id="customerId" name="customerId">
                                </div>
                            </div>
                            <div class="form-row">
                                <!--there will be more than one of these-->
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Product SKU</label>
                                    <input type="text" class="form-control" id="productsku-1" name="productsku-1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Product Price</label>
                                    <input type="text" class="form-control" id="productprice-1" name="productprice-1">
                                </div>
                                <!--end of first product-->
                            </div>
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="text" class="form-control" id="" placeholder="">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">NEXT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
<script>
    var host = 'https://stg-hollister.smithbuy.com/rest';
    var appHeader = {
        "Authorization": "Bearer <?php echo $accessToken?>",
        "Content-Type": "application/json"
    };

    let customerId = 2041; //Ty Kailet on staging
    let item = {"sku": "INTEL.CP80617004119AE.SLBNB.1001.TR.NA", "qty": 1, "price": 15.00}; //price needs to be changed during negotiable quote process

    /**
     * 1. Create customer cart quote
     **/
    createEmptyCart(customerId).then(response => {
        return parseInt(response);
    }).then(cartId => {
        console.log(`Created cart ID: ${JSON.stringify(cartId, null, 4)}`);
        /**
         * 2. Add an item to the quote cart.
         **/
        return addItemToCart(cartId, item).then( cartItem => {
            console.log(`Added cart item: ${JSON.stringify(cartItem, null, 4)}`);
            return cartItem;
        });
    }).catch(err => err.responseText);

    $("#step-1").submit(function( event ) {
        event.preventDefault();
        var formdata = $(this).serializeArray();
        var request = {};
        formdata.forEach(field => request[field.name] = field.value);
    });

    async function createEmptyCart(customerId){
        return await $.ajax({
            url: host + `/V1/customers/${customerId}/carts`,
            type: 'post',
            headers: appHeader,
            dataType: 'json',
            context: this
        }).done(result => result)
          .catch(err => err.responseText);
    }

    async function addItemToCart(cartId, item){
        item.quote_id = cartId;
        return await $.ajax({
            url: host + `/V1/carts/${cartId}/items`,
            type: 'post',
            headers: appHeader,
            data: JSON.stringify({"cartItem": item}),
            dataType: 'json',
            context: this
        }).done(result => result)
          .catch(err => err.responseText);
    }
</script>
</body>
</html>



