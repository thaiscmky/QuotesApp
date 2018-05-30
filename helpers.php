<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function postRequest($url, $headers, $data = false){
    $result = null;
    $ch = curl_init($url);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        $headers
    );
    curl_setopt($ch, CURLOPT_POST, 1);
    if($data)
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode(
            $data
        ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result);
}