<?php
header('Content-Type:  application/xml');

$url = "https://url:5443/rest/measurements/list";
$username = 'user';
$password = 'password';



$post = '<taggablereference domain="Measurement" obid="126095"/>';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

$response = curl_exec($ch);

curl_close($ch);
echo $response;
