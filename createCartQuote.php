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







