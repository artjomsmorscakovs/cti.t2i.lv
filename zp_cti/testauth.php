<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

/*
$ch = curl_init();
$header = array(
    'Content-type: application/vnd.api+json',
    'Accept: application/vnd.api+json',
 );
$postStr = json_encode(array(
    'grant_type' => 'password',
    'client_id' => 'cab97968-8ff5-b655-9f5e-5ae2fd726492',
    'client_secret' => 'd938225b-3177-5ec7-d356-5adde6e5ee3e',
    'username' => 'admin',
    'password' => 'T2I298220031',
    'scope' => 'standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete'
));
$url = 'https://crm1.t2i.lv/api/oauth/access_token';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$output = curl_exec($ch);

print_r($output);
echo 'ok';*/


    require_once './lib/SuiteCRMClient.php';

    $client = new SuiteCRMClient();

    print_r($client);
    $data = array(
        "data" => array(
            "id" => "",
            "type" => "t2ilc_t2i_lmt_calls",
            "attributes" => array(
                "name" => "qweqwewq",
               // "caller" => "MrSatoshi",
                //"callid" => "12345678",
                //"contactid" => "2323rewf4",
                //"status" => "Failed",
            ),
        )
    );

    $update = array(
        "data" => array (
            "id" => "daf730c6-0731-ac81-e553-5ae429e377c2",
            "type" => "t2ilc_t2i_lmt_calls",
            "attributes" => array(
                "name" => "itworks",
                //"caller" => "MrSatoshi",
                //"callid" => "12345678",
                //"contactid" => "2323rewf4",
                //"status" => "Failed",
            ),
        ),
);
    // record=e3c55321-f398-2381-2cd4-5ae34c07a3fa

    //$client->createEntry($data); - CREATES ENTRY. array as an input
    //$client->retrieveEntry("e3c55321-f398-2381-2cd4-5ae34c07a3fa"); - RETRIEVES ENTRY BY ID
    //$client->updateEntry($update); - UPDATES ENTRY (id must be included) array as an input
    //$client->deleteEntry('e3c55321-f398-2381-2cd4-5ae34c07a3fa'); - DELETES ENTRY BY ID

    $output = $client->retrieveEntry('1234daf730c6-0731-ac81-e553-5ae429e377c2');

    if ($output == false) {
        echo "<h1>OUTPUT IS TRUE</h1>";
    } else {
        echo "<h1>OUTPUT IS FALSE</h1>";
    }
    //IF ERROR then it false value;



?>