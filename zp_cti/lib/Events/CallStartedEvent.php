<?php
require_once 'Event.php';

class CallStartedEvent extends Event{
    /*
    public $callid;
    public $caller;
    public $destination;
    public $direction;
    public $status;
    public $callstarted;
    public $contactid;
    */

    public function __construct(){

    }


    public function setData($data){
        $this->data = $data;
        $this->parseFolderPath($data);

        /*
        $this-> $callid = $data->data->attributes->callID;
        $this-> $caller = $data->data->attributes->caller;
        $this-> $destination = $data->data->attributes->destination;
        $this-> $direction = $data->data->attributes->direction;;
        $this-> $status = $data->data->attributes->status;
        $this-> $callstarted = $data->data->attributes->callStarted;
        $this-> $contactid = $data->data->attributes->contactID;
        */
    }

    /*
        public  $type;
        public  $eventType;
        public  $version;
        public  $data;
        protected  $datetime;
        protected	$folderpath;
        protected	$filename;

        {
          "type": "Event",
          "eventType": "CallStarted",
          "version": "v1",
          "data": {
            "callID": 150818921852,
            "caller": "22222222",
            "destination": "23333333",
            "direction": "in",
            "status": 1,
            "callStarted": "2017-10-16T21:26:59+0000",
            "contactID": 224
          }
        }
    */
}

?>