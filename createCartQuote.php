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

function getCarrierByCode($carrier_code){
    global $info;
    foreach ($info['shippingCarriers'] as $carrier){
        $carrier = json_decode(json_encode($carrier), true);
        if($carrier['carrier_code'] === $carrier_code){
            return $carrier;
        }
    }
}

function getCustomerInformation(){
    global $host, $accessToken, $info;
    $info['customerInfo'] = getRequest(
        $host . "/V1/customers/{$info['customerId']}",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"]
    );

    $info['customerInfo'] = json_decode(json_encode($info['customerInfo']), true);

    return $info['customerInfo'];
}

function getCustomerCompanyById($companyId){
    global $host, $accessToken, $info;
    $info['companyInfo'] = getRequest(
        $host . "/V1/company/$companyId",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"]
    );

    $info['companyInfo'] = json_decode(json_encode($info['companyInfo']), true);

    return $info['companyInfo'];
}

function setShippingInformation($address, $carrier_code){
    global $host, $accessToken, $info;
    $customerInfo = getCustomerInformation();
    $companyInfo = getCustomerCompanyById($customerInfo['extension_attributes']["company_attributes"]["company_id"]);
    $info['shippingCarrierInfo'] = getCarrierByCode($carrier_code);

    $shippingInfo = [
      'addressInformation' => [
          'shipping_address' => array_merge($address, [
              "firstname" => $customerInfo['firstname'], "lastname" => $customerInfo['lastname'],
              "company" => $companyInfo['company_name']
          ]),
          'billing_address' => array_merge($address, [
              "firstname" => $customerInfo['firstname'], "lastname" => $customerInfo['lastname'],
              "company" => $companyInfo['company_name']
          ]),
          'shipping_carrier_code' => $carrier_code,
          'shipping_method_code' => $info['shippingCarrierInfo']['method_code'],
          'extension_attributes' => [],
          'custom_attributes' => []
      ]
    ];

    $info['shippingInfoResponse'] = postRequest(
        $host . "/V1/carts/{$info['cartId']}/shipping-information",
        ['Content-Type: application/json', "Authorization: Bearer $accessToken"],
        $shippingInfo
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





