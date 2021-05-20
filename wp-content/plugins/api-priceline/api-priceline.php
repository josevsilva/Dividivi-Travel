<?php
/*
Plugin Name: API-Priceline
Plugin URI: 
Description: Plugin to connect and consume the Priceline API services
Version: 1.0
Author: Jose Villar
Author URI: 
License: 
License URI: 
*/

function call_api(){

$curl = curl_init();
    $api_url = 'https://api-sandbox.rezserver.com/api/';
    $refid = '10068';
    $api_key = 'f8e4553f1837afa17047b7fdb9c6924a';

curl_setopt_array($curl, [
    CURLOPT_URL => $api_url."/shared/getBOF2.Downloads.Hotel.Hotels?format=json2&refid=".$refid."&api_key=".$api_key."&limit=2",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Cache-Control: no-cache"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}

} 