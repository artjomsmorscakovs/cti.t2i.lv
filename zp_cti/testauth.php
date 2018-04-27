<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
$ch = curl_init();
$header = array(
   'Content-type: application/vnd.api+json',
   'Accept: application/vnd.api+json',
);
$url = 'https://crm1.t2i.lv/api/v8/modules/meta/list';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');;
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);*/




/*
$ch = curl_init();
$header = array(
    'Content-type: application/vnd.api+json',
    'Accept: application/vnd.api+json',
 );
$postStr = json_encode(array(
    'grant_type' => 'client_credentials',
    'client_id' => 'ZvanuParvaldnieks',
    'client_secret' => 'd938225b-3177-5ec7-d356-5adde6e5ee3e',
    'scope' => 'standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete'
));
$url = 'https://crm1.t2i.lv/api/oauth2';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);*/


$ch = curl_init();
$header = array(
    'Content-type: application/vnd.api+json',
    'Accept: application/vnd.api+json',
 );
$postStr = json_encode(array(
    'grant_type' => 'password',
    'client_id' => 'zptestapi',
    'client_secret' => 'b0eb51cf-bc5d-cd25-c26d-5ae2f6f754e4',
    'username' => 'admin',
    'password' => 'T2I298220031',
    'scope' => 'standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete'
));
$url = 'http://crm1.t2i.lv/api/oauth/access_token';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);



print_r($output);
echo 'ok';

?>