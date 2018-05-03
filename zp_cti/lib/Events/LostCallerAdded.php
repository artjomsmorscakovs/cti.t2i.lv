<?php

class LostCallerAdded extends Event{

    public $contact_name_c;
    public $destination;
    public $attempts_c;
    public $callerid_c;
    public $last_contact_c;

    public function setData($data){
        $this->data = $data;
        $this->parseFolderPath($data);

        $this-> $contact_name_c = $data->data->attributes->contact_name;
        $this-> $destination = $data->data->attributes->destination;
        $this-> $attempts_c  = $data->data->attributes->attempts;
        $this-> $callerid_c  = $data->data->attributes->callerid;
        $this-> $last_contact_c = $data->data->attributes->last_contact;
    }
    /*
     *
        public  $type;
        public  $eventType;
        public  $version;
        public  $data;
        protected  $datetime;
        protected   $folderpath;
        protected   $filename;

    {
      "type": "Event",
      "eventType": "LostCallerAdded",
      "version": "v1",
      "data": {
        "contact_name": "Andris Berzins",
        "destination": "23332222",
        "attempts": 3,
        "callerid 22222222": "Hello, world!",
        "last_contact `2018-01-16T11:26:59+0000`(required,string) -  Time when the last unsuccessful call attempt was made from caller. Format: YYYY-MM-DDTH24:mm:SS+UTC_OFFSET": "Hello, world!"
      }
    }


    */
}


?>