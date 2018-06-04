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

function setNegotiableShippingMethod($carrier_code){

    global $host, $accessToken, $info;
    $info['quoteShippingInfo'] = putRequest(
        $host . "/V1/negotiableQuote/{$info['cartId']}/shippingMethod",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        ['shippingMethod' => $carrier_code]
    );
}

function setNegotiablePrice($value, $type = 3){

    global $host, $accessToken, $info;

    $info['setQuotePrice'] = putRequest(
        $host . "/V1/negotiableQuote/{$info['cartId']}",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        ['quote' => [
            'id' => $info['cartId'],
            'extension_attributes' => [
                'negotiable_quote' => [ 'negotiated_price_type' => $type, 'negotiated_price_value' => $value]
            ]
        ]]
    );
}

function getNegotiableQuoteInfo() {

    global $host, $accessToken, $info;

    $negotiable_quote = getRequest(
        $host . "/V1/carts/{$info['cartId']}",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"]
    );

    $negotiable_quote = json_decode(json_encode($negotiable_quote), true);
    return $negotiable_quote;
}