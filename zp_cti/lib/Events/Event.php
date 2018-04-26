<?php
class Event {
	public  $type;
	public  $eventType;
	public  $version;
	public  $data;
	protected  $datetime;
	protected	$folderpath;
	protected	$filename;
	
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
}
?>