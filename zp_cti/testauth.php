<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);


$ch = curl_init();
$header = array(
    'Content-type: application/vnd.api+json',
    'Accept: application/vnd.api+json',
 );
$postStr = json_encode(array(
    'grant_type' => 'client_credentials',
    'client_id' => 'd938225b-3177-5ec7-d356-5adde6e5ee3e',
    'client_secret' => 'client_secret',
    'scope' => 'standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete'
));
$url = 'https://path-to-instance/api/oauth/access_token';
curl_setopt($ch, CURLOPT_URL, url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);


?>