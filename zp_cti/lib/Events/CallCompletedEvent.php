<?php
require_once 'Event.php';

class CallCompletedEvent extends Event{

    public $callid;
    public $caller;
    public $destination;
    public $direction;
    public $status;
    public $callstarted;
    public $callconnected_c;
    public $connectiontime_c;
    public $contactid;
    public $previous_contactid_c;

    public function setData($data){
        $this->data = $data;
        $this->parseFolderPath($data);

        $this-> $callid = $data->data->attributes->callID;
        $this-> $caller = $data->data->attributes->caller;
        $this-> $destination = $data->data->attributes->destination;
        $this-> $direction = $data->data->attributes->direction;;
        $this-> $status = $data->data->attributes->status;
        $this-> $callstarted = $data->data->attributes->callStarted;
        $this-> $callconnected_c =$data->data->attributes->callConnected;
        $this-> $contactid = $data->data->attributes->contactID;
        $this-> $previous_contactid_c = $data->data->attributes->contactID;
    }
/*
    public  $type;
    public  $eventType;
    public  $version;
    public  $data;
    protected  $datetime;
    protected   $folderpath;
    protected   $filename;

    {
      "type": "Event",
      "eventType": "CallCompleted",
      "version": "v1",
      "data": {
        "callID": 150818921852,
        "caller": "22222222",
        "destination": "23333333",
        "direction": "in",
        "status": 1,
        "callStarted": "2017-10-16T21:26:59+0000",
        "callConnected": "2017-10-16T21:26:59+0000",
        "connectionTime": 112,
        "contactID": 224,
        "previous_contactID: 221(required,number) - `contact_id` of Employee who initiated the transfer": "Hello, world!"
      }
    }



*/
}
 


?>