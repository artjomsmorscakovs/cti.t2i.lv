<?php
class Event {
	public  $type;
	public  $eventType;
	public  $version;

	public  $data;
	protected  $datetime;
	protected	$folderpath;
	protected	$filename;

	public function setData($data){
		$this->data = $data;
		$this->parseFolderPath($data);
		
	}	
	
	public function parseFolderPath($data){
		//2018-04-25T13:54:19+0000
		$sep = "_";
		
		$this->datetime = $data->callStarted;
		$datepath = $this->parseDateTimePath($data->callStarted);
		$datefilename = $this->parseDateTimeFileName($data->callStarted);
		
		$this->folderpath = 'zp_cti'.DIRECTORY_SEPARATOR.'request_log'.DIRECTORY_SEPARATOR.$data->contactID.DIRECTORY_SEPARATOR.$data->direction.DIRECTORY_SEPARATOR.$datepath.DIRECTORY_SEPARATOR;
		$this->filename = $data->callID.$sep.$data->caller.$sep.$data->destination.$sep.$datefilename.$sep.$this->eventType.".xml";
		//zp_cti/request_log/966/in/
		//1524664459097344_27771153_29822031_datetime.xm;
	}	
	
	public function parseDateTimePath($datetime){
		$result = '' ;
		if(!empty($datetime)){
			$datearr = date_parse($datetime);
			$datearr = $this->strpaddate($datearr);
			
			$result = $datearr['year'].DIRECTORY_SEPARATOR.$datearr['month'].DIRECTORY_SEPARATOR.$datearr['day'];
		}else {
			$result = date('Y/m/d');
		}
		//return 2018/04/26
		return $result;
	}
	
	public function parseDateTimeFileName($datetime){
		$result = '' ;
		$sep = "_";
		if(!empty($datetime)){
			$datearr = date_parse($datetime);
			$datearr = $this->strpaddate($datearr);
			
			$result = $datearr['year'].$sep.$datearr['month'].$sep.$datearr['day'].$sep.$datearr['hour'].$sep.$datearr['minute'].$sep.$datearr['second'];
		}else {
			$result = date('Y_m_d_H_i_s');
		}
		//return 2018/04/26
		return $result;
	}
	
	private function strpaddate($datearr){
		$datearr['month'] = str_pad($datearr['month'], 2, "0", STR_PAD_LEFT);
		$datearr['day'] = str_pad($datearr['day'], 2, "0", STR_PAD_LEFT);
		$datearr['hour'] = str_pad($datearr['hour'], 2, "0", STR_PAD_LEFT);
		$datearr['minute'] = str_pad($datearr['minute'], 2, "0", STR_PAD_LEFT);
		$datearr['second'] = str_pad($datearr['second'], 2, "0", STR_PAD_LEFT);
		
		return 	$datearr;
	}
	
    public function __toArray(){
        //return call_user_func('get_object_vars', $this);
        return get_object_vars($this);
    }
	
	public function getFolderPath(){
		return $this->folderpath;
	}	

	public function getFileName(){
		return $this->filename;
	}	

}
?>