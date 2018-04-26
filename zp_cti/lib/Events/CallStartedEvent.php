<?php
require_once 'Event.php';

class CallStartedEvent extends Event{
/*
	public  $type;
	public  $eventType;
	public  $version;
	public  $data;
	protected  $datetime;
	protected	$folderpath;
	protected	$filename;
*/
	
	public function setData($data){
		$this->data = $data;
		$this->parseFolderPath($data);
		
	}
	
	private function parseFolderPath($data){
		//2018-04-25T13:54:19+0000
		$sep = "_";
		
		$this->datetime = $data->callStarted;
		$datepath = $this->parseDateTimePath($data->callStarted);
		$datefilename = $this->parseDateTimeFileName($data->callStarted);
		
		$this->folderpath = 'zp_cti'.DIRECTORY_SEPARATOR.'request_log'.DIRECTORY_SEPARATOR.$data->contactID.DIRECTORY_SEPARATOR.$data->direction.DIRECTORY_SEPARATOR.$datepath.DIRECTORY_SEPARATOR;
		$this->filename = $data->callID.$sep.$data->caller.$sep.$data->destination.$sep.$datefilename.".xml";
		//zp_cti/request_log/966/in/
		//1524664459097344_27771153_29822031_datetime.xm;
	}

	
}

?>