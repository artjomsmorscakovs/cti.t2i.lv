<?php

class VoiceMailCreatedEvent extends Event
{
    /*
     $sender_c;
     $voicemailid_c;
     $length_c;
     $callstarted;
     $voicemailboxid_c;
     $voicemailboxname_c;
     $messageurl_c;
    */

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