<?php

phpinfo();
die();


header("Content-Type: application/json; charset=UTF-8");

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://httpbin.org/get',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_FOLLOWLOCATION => true,
));

$response = curl_exec($curl);
var_dump($curl);
echo json_decode($response);


curl_close($curl);

