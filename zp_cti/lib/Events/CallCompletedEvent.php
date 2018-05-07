<?php

class CallCompletedEvent extends Event{

    /*
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
    */

    public function toArray(){

        $callid = $this->data->callID;
        $caller = $this->data->caller;
        $destination = $this->data->destination;
        $direction = $this->data->direction;
        $status = $this->data->status;
        $callstarted = $this->data->callStarted;
        $callconnected_c = $this->data->callConnected;
        $connectiontime_c = $this->data->connectionTime;
        $contactid = $this->data->contactID;
        $previous_contactid_c = $this->data->previous_contactID;


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
                    'callconnected_c' => $callconnected_c,
                    'connectiontime_c' => $connectiontime_c,
                    'contactid' => $contactid,
                    'previous_contactid_c' => $previous_contactid_c
                )
            )
        );

        return $arr;
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