<?php
require_once 'Event.php';

class VoiceMailCreatedEvent extends Event
{
    public $sender_c;
    public $voicemailid_c;
    public $length_c;
    public $callstarted;
    public $voicemailboxid_c;
    public $voicemailboxname_c;
    public $messageurl_c;

    public function setData($data){

        $this->data = $data;
        $this->parseFolderPath($data);

        $this-> $sender_c = $data->data->attributes->sender;
        $this-> $voicemailid_c = $data->data->attributes->voicemailID;
        $this-> $length_c = $data->data->attributes->length;
        $this-> $callstarted = $data->data->attributes->callStarted;
        $this-> $voicemailboxid_c = $data->data->attributes->voicemailBoxID;
        $this-> $voicemailboxname_c = $data->data->attributes->voicemailBoxName;
        $this-> $messageurl_c = $data->data->attributes->messageURL;
        /*
        {
            "type": "Event",
            "eventType": "VoicemailCreated",
            "version": "v1",
            "data": {
                "sender": "23332222",
                "voicemailID": 171118926552,
                "length": 45,
                "callStarted": "2017-10-16T21:26:59+0000",
                "voicemailBoxID": 223,
                "voicemailBoxName": "User voicemail box",
                "messageURL": "https://zvanuparvaldnieks.lmt.lv/files/dm0vNzI349857345dfvjdfTYUTDfdHIYEWDUIDY5MDQwMy8yMDE3LzEwNC5tcDM="
          }
        } */




    }
    /*
        public  $type;
        public  $eventType;
        public  $version;
        protected  $datetime;
        protected   $folderpath;
        protected   $filename;
        "sender": "23332222",
        "voicemailID": 171118926552

        {
          "type": "Event",
          "eventType": "VoicemailCreated",
          "version": "v1",
          "data": {
            "sender": "23332222",
            "voicemailID": 171118926552,
            "length": 45,
            "callStarted": "2017-10-16T21:26:59+0000",
            "voicemailBoxID": 223,
            "voicemailBoxName": "User voicemail box",
            "messageURL": "https://zvanuparvaldnieks.lmt.lv/files/dm0vNzI349857345dfvjdfTYUTDfdHIYEWDUIDY5MDQwMy8yMDE3LzEwNC5tcDM="
          }
        }
    */

}
?>