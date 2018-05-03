<?php

class LostCallerRemoved extends Event{

    public $destination;
    public $callerid_c;

    public function setData($data){
        $this->data = $data;
        $this->parseFolderPath($data);

        $this-> $destination = $data->data->attributes->destination;
        $this-> $callerid_c  = $data->data->attributes->callerid;
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
      "eventType": "LostCallerRemoved",
      "version": "v1",
      "data": {
        "destination": "23332222",
        "callerid 22222222": "Hello, world!"
      }
    }


    */
}


?>