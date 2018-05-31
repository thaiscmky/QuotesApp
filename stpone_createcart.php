<?php
include_once 'main.php';

global $request, $info, $accessToken;

createEmptyCart($request['customerId']);

echo json_encode($info);