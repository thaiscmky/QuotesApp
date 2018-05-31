<?php
include_once 'main.php';

global $request, $info, $accessToken;

addItemsToCart($request['cartItems']);
if(isset($request['address'])){
    getShippingRates($request['address']);
}

echo json_encode($info);