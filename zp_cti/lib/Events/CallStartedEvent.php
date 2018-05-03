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

    //public function setData($data){

        /*
        $this-> $callid = $data->data->attributes->callID;
        $this-> $caller = $data->data->attributes->caller;
        $this-> $destination = $data->data->attributes->destination;
        $this-> $direction = $data->data->attributes->direction;;
        $this-> $status = $data->data->attributes->status;
        $this-> $callstarted = $data->data->attributes->callStarted;
        $this-> $contactid = $data->data->attributes->contactID;
        */
   // }

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
    public function toArray(){

        $callid = $this->$data->data->callid;
        $caller = $this->$data->data->caller;
        $destination = $this->$data->data->destination;
        $direction = $this->$data->data->direction;
        $status = $this->$data->data->status;
        $callstarted = $this->$data->data->callstarted;
        $contactid = $this->$data->data->contactid;


        $arr = array(
            'data' => array(
                'id'=>'',
                'type'=>'t2ilc_t2i_lmt_calls',
                'attributes' => array(
                    'name'=> $caller,
                    'callid' => $callid,
                    'caller' => $caller,
                    'destination' => $destination,
                    'direction' => $direction,
                    'status' => $status,
                    'callstarted' => $callstarted,
                    'contactid' => $contactid
                )
            )
        );

        return $arr;
    }
}


?>