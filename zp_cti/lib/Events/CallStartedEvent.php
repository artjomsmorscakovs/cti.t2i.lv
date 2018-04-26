<?php
class CallStartedEvent{
	public  $type;
	public  $eventType;
	public  $version;
	public  $data;
	public  $datetime;
	public	$folderpath;
	public	$filename;
	
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
		$this->filename = $data->callStarted.$sep.$data->caller.$sep.$data->destination.$sep.$datefilename.".xml";
		//zp_cti/request_log/966/in/
	}
	
	private function parseFileName($data){
		
		
		//1524664459097344_27771153_29822031_datetime
	}
	
	private function parseDateTimePath($datetime){
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
	
	private function parseDateTimeFileName($datetime){
		$result = '' ;
		$sep = "_";
		if(!empty($datetime)){
			$datearr = date_parse($datetime);
			$result = $datearr['year'].$sep.$datearr['month'].$sep.$datearr['day'].$sep.$datearr['hour'].$sep.$datearr['minute'].$sep.$datearr['second'];
		}else {
			$result = date('Y_m_d_H_i_s');
		}
		//return 2018/04/26
		return $result;
	}	
}

?>