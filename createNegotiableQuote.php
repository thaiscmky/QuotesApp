<?php

global $request, $info, $accessToken;

function requestNegotiableQuote($name, $comment = null){

    global $host, $accessToken, $info;
    $info['quoteCreated'] = postRequest(
        $host . "/V1/negotiableQuote/request",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        ['quoteName' => $name, 'quote_id' => $info['cartId'], 'comment' => $comment ]
    );
}

function getShippingRates($address){

    global $host, $accessToken, $info;

    $info['shippingCarriers'] = postRequest(
        $host . "/V1/negotiable-carts/{$info['cartId']}/estimate-shipping-methods",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        ['address' => $address]
    );

}

function setNegotiableShippingInfo($address, $carrier_code){

    global $host, $accessToken, $info;

    $info['shippingInfo'] = postRequest(
        $host . "/V1/negotiable-carts/{$info['cartId']}/shipping-information",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        ['addressInformation' => [
            'shipping_address' => $address,
            'billing_address' => $address,
            'shipping_method_code' => $carrier_code
        ]]
    );
}