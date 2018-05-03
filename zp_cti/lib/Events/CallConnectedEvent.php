<?php

class CallConnectedEvent extends Event{

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
      "eventType": "CallConnected",
      "version": "v1",
      "data": {
        "callID": 150818921852,
        "caller": "22222222",
        "destination": "23333333",
        "direction": "in",
        "status": 1,
        "callStarted": "2017-10-16T21:26:59+0000",
        "callConnected": "2017-10-16T21:26:59+0000",
        "contactID": 224
      }
    }

*/


    public function toArray(){

        $callid = $this->data->callid;
        $caller = $this->data->caller;
        $destination = $this->data->destination;
        $direction = $this->data->direction;
        $status = $this->data->status;
        $callstarted = $this->data->callstarted;
        $callconnected_c = $this->data->callconnected;
        $contactid = $this->data->contactid;


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
                    'contactid' => $contactid
                )
            )
        );

        return $arr;
    }
}


?>