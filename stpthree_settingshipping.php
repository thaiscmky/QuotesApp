<?php
include_once 'main.php';

global $request, $info, $accessToken;

setShippingInformation($request['address'], $request['carrier']);

echo json_encode($info);