<?php
require_once 'Event.php';

class VoiceMessageDeleted extends Event
{
    /*
        public  $type;
        public  $eventType;
        public  $version;
        protected  $datetime;
        protected   $folderpath;
        protected   $filename;
     *
        "sender": "23332222",
        "voicemailID": 171118926552
    */

    public function parseFolderPath($data)
    {
        //2018-04-25T13:54:19+0000
        $sep = "_";
        $datetime = date('Y/m/d'); //when voice mail deleted TODO Maybe put DIRECTORY_SEPARATOR?
        $datefilename = date('Y_m_d_H_i_s');

        $this->folderpath = 'zp_cti' . DIRECTORY_SEPARATOR . 'request_log' . DIRECTORY_SEPARATOR . $data->sender . DIRECTORY_SEPARATOR . $datetime . DIRECTORY_SEPARATOR;
        $this->filename = $data->voicemailID . $sep . $data->sender . $sep . $datefilename . $sep . $this->eventType . ".xml";
    }
}
?>