<?php
require_once 'Event.php';

class CallStartedEvent extends Event{

    //callstarted
    public $callid;
    public $caller;
    public $destination;
    public $direction;
    public $status;
    public $callstarted;
    public $contactid;
    //callstarted = $data->data->attributes->callStarted

    //callconnected


    //callcompleted


    //voicemailcreated
    public $sender_c;
    public $voicemailid_c;
    public $length_c;
    public $callstarted;
    public $voicemailboxid_c;
    public $voicemailboxname_c;
    public $messageurl_c;

    //voicemaildeleted
    public $sender_c;
    public $voicemailid_c;

    //lostcalleradded
    public $contact_name_c;
    public $destination;
    public $attempts_c;
    public $callerid_c;
    public $last_contact_c;

    //lostcallerupdated
    public $contact_name_c;
    public $destination;
    public $attempts_c;
    public $callerid_c;
    public $last_contact_c;

    //lostcallremoved
    public $destination;
    public $callerid_c;

    public function setData($data){
        $this->data = $data;
        $this->parseFolderPath($data);

        $this-> $callid = $data->data->attributes->callID;
        $this-> $caller = $data->data->attributes->caller;
        $this-> $destination = $data->data->attributes->destination;
        $this-> $direction = $data->data->attributes->direction;;
        $this-> $status = $data->data->attributes->status;
        $this-> $callstarted = $data->data->attributes->callStarted;
        $this-> $contactid = $data->data->attributes->contactID;
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