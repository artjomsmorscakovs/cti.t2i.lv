<?php
class CallStartedEvent{
	public  $type;
	public  $eventType;
	public  $version;
	public  $data;
	public  $datetime;
	public	$folderpath;
	
	public function setData($data){
		$this->data = $data;
		$this->parseFolderPath($data);
		
	}
	
	private function parseFolderPath($data){
		//2018-04-25T13:54:19+0000
		
		$this->datetime = $data->callStarted;
		$datepath = $this->parseDateTime($data->callStarted);
		
		$this->folderpath = 'zp_cti'.DIRECTORY_SEPARATOR.'request_log'.DIRECTORY_SEPARATOR.$data->contactID.DIRECTORY_SEPARATOR.$data->direction.DIRECTORY_SEPARATOR.$datepath.DIRECTORY_SEPARATOR;
		
		//zp_cti/request_log/966/in/
	}
	
	private function parseDateTime($datetime){
		$result = '' ;
		if(!empty($datetime)){
			$datearr = date_parse($datetime);
			$result = $datearr['year'].DIRECTORY_SEPARATOR.$datearr['month'].DIRECTORY_SEPARATOR.$datearr['day'];
		}else {
			$result = date('Y/m/d');
		}
		//return 2018/04/26
		return $result;
	}
}

?>