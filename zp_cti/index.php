<?php
/**
 * @author Artjoms Morscakovs
 * @website	https://t2i.lv
 * 
 */
 
 require_once("./lib/jsonhandler.php");
 require_once './lib/RequestFileLog.php';
 require_once './lib/JsonMapper.php';
  // require_once './lib/Events/Event.php';
 require_once './lib/Events/CallStartedEvent.php';
 
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
 
//If json_decode failed, the JSON is invalid.
/*
if(!is_array($decoded)){
    throw new Exception('Received content contained invalid JSON!');
}*/


$string_data = serialize($decoded);

$mapper = new JsonMapper();
$requestObject = $mapper->map($decoded, new CallStartedEvent());

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
?>