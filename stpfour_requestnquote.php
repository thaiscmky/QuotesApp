<?php
include_once 'main.php';

global $request, $info, $accessToken;

requestNegotiableQuote($request['quoteName'], isset($request['quoteComment']) ? $request['quoteComment'] : '');
setNegotiablePrice($request['quotePrice']);
setNegotiableShippingMethod($info['shippingCarrierInfo']['carrier_code']);

echo json_encode($negotiable_quote);