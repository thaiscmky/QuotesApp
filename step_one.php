<?php
include_once 'accesstokens.php';
include_once 'helpers.php';
include_once 'createCartQuote.php';
include_once 'createNegotiableQuote.php';

$request = $_POST;
$info = [];

createEmptyCart($request['customerId']);
addItemsToCart($request['cartItems']);
requestNegotiableQuote($request['quoteName'], $request['quoteComment']);

if($request['address']){
    getShippingRates($request['address']);
}

echo json_encode($info);