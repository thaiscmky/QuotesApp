<?php

global $request, $info, $accessToken;

function createEmptyCart($customerId){
    global $host, $accessToken, $info;
    $info['customerId'] = (int)$customerId;
    $info['cartId'] = (int)postRequest(
        $host . "/V1/customers/$customerId/carts",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"]
    );
}

function addItemsToCart($items){

    global $host, $accessToken, $info;
    $info['itemsAdded'] = [];
    foreach ($items as $key => $item){
        $sku = $item['sku'];
        $qty = (int)$item['qty'];
        $info['itemsAdded'][$sku] = postRequest(
            $host . "/V1/carts/{$info['cartId']}/items",
            ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
            ["cartItem" => [ 'sku' => $sku, 'qty' => $qty, 'quote_id' => $info['cartId'] ] ]
        );
    }
}

function setShippingAddress($address){
    global $host, $accessToken, $info;
    $info['shippingAddress'] = postRequest(
        $host . "/V1/carts/{$info['cartId']}/billing-address", //V1/carts/mine/billing-address
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        ['cartId' => $info['cartId'], 'address' => $address]
    );
}
function getShippingRates($address){

    global $host, $accessToken, $info;
    $info['shippingCarriers'] = postRequest(
        $host . "/V1/carts/{$info['cartId']}/estimate-shipping-methods",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        ['address' => $address]
    );

}





