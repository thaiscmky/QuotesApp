<?php
include_once 'step_one.php';

global $request, $info, $accessToken;

if($request['address']){
    setNegotiableShippingInfo($request['address']);
}

echo json_encode($info);