<?php

class VoiceMailMessageDeletedEvent extends Event
{
    public $sender_c;
    public $voicemailid_c;

    public function setData($data){
        $this->data = $data;
        $this->parseFolderPath($data);

        $this-> $sender_c = $data->data->attributes->sender;
        $this-> $voicemailid_c = $data->data->attributes->voicemailID;
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
          "eventType": "VoicemailDeleted",
          "version": "v1",
          "data": {
            "sender": "23332222",
            "voicemailID": 171118926552
          }
        }
*/

}

?>