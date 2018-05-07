<?php
/**
 * @author Artjoms Morscakovs
 * @website	https://t2i.lv
 *
 */

require_once("./lib/jsonhandler.php");
require_once './lib/RequestFileLog.php';
require_once './lib/JsonMapper.php';
// require_once 'Event.php';\

//Class to work with SuiteCRM
require_once './lib/SuiteCRMClient.php';

//Specific Event Classes
require_once './lib/Events/Event.php';


//Receive the RAW post data.
$decoded = 'a:4:{s:9:"eventType";s:11:"CallStarted";s:7:"version";s:2:"v1";s:4:"type";s:5:"Event";s:4:"data";a:7:{s:6:"status";i:1;s:9:"direction";s:3:"out";s:11:"destination";s:8:"29822031";s:6:"callID";i:1524664459097344;s:6:"caller";s:8:"27771153";s:9:"contactID";i:969;s:11:"callStarted";s:24:"2018-04-25T13:54:19+0000";}}';

//Attempt to decode the incoming RAW post data from JSON.
$decoded = json_decode($content);


//If json_decode failed, the JSON is invalid.
/*
if(!is_array($decoded)){
    throw new Exception('Received content contained invalid JSON!');
}*/


$classname = $decoded->eventType.'Event';
$mapper = new JsonMapper();
$requestObject = $mapper->map($decoded, new $classname());

print_r($requestObject);
echo 'requestObject1';

$logger = new RequestFileLog();
$logger->logRequest($requestObject);
echo 'logRequest';
//print_r($_SERVER[ 'DOCUMENT_ROOT' ]);
//echo 'DOCUMENT_ROOT';
// $filelog = new RequestFileLog('zp_cti/request_log/966/in/2018/04/26');
// echo '26';
//file_put_contents("./request_log/request".date('Y-m-d H:i:s').".xml", $string_data);

//print_r($filelog);
//Process the JSON.

$client = new SuiteCRMClient();

//$requestObject; - map (json_decode($output))

$arrtocrm = $requestObject->toArray();
$response = $client->findByCall_ID($arrtocrm['data']['attributes']['callid']);

if (isset($response->data->id) && !empty($response->data->id)) {
    $arrtocrm['data']['id'] = $response->data[0]->id;
    $client->updateEntry($arrtocrm);
} else {
    $client->createEntry($arrtocrm);
}



?>