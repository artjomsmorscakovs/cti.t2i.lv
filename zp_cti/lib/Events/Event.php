<?php
class Event {
	public  $type;
	public  $eventType;
	public  $version;
	public  $data;
	public  $datetime;
	public	$folderpath;
	public	$filename;
	
	public function parseDateTimePath($datetime){
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
	
	public function parseDateTimeFileName($datetime){
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