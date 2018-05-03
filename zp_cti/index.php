<?php
/**
 * @author Artjoms Morscakovs
 * @website	https://t2i.lv
 * 
 */
 
require_once("./lib/jsonhandler.php");
require_once './lib/RequestFileLog.php';
require_once './lib/JsonMapper.php';
// require_once './lib/Events/Event.php';\

//Class to work with SuiteCRM
require_once './lib/SuiteCRMClient.php';

//Specific Event Classes
require_once './lib/Events/CallStartedEvent.php';
require_once './lib/Events/CallCompletedEvent.php';
require_once './lib/Events/CallConnectedEvent.php';
require_once './lib/Events/VoicemailCreatedEvent.php';
require_once './lib/Events/VoiceMailMessageDeletedEvent.php';
require_once './lib/Events/LostCallerAdded.php';
require_once './lib/Events/LostCallerUpdated.php';
require_once './lib/Events/LostCallerRemoved.php';

 //error_reporting(E_ALL);
 //ini_set('display_errors', 1);
 
//Make sure that it is a POST request.
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
    throw new Exception('Request method must be POST!');
}
 
//Make sure that the content type of the POST request has been set to application/json
$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
if(strcasecmp($contentType, 'application/json') != 0){
    throw new Exception('Content type must be: application/json');
}
 
//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));
 
//Attempt to decode the incoming RAW post data from JSON.
$decoded = JsonHandler::decode($content);

//print_r($decoded);
 
//If json_decode failed, the JSON is invalid.
/*
if(!is_array($decoded)){
    throw new Exception('Received content contained invalid JSON!');
}*/


$string_data = serialize($decoded);
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

$response = $client->findByCall_ID($requestObject->data->attributes->callid);

if (isset($response->data->id) && !empty($response->data->id)) {
    $requestObject->data->id = $response->data[0]->id;
    $client->updateEntry($requestObject);
} else {
    $client->createEntry($requestObject);
}





?>