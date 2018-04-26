<?php

class RequestFileLog {
	private $basepath;
	
	function __construct($folder){
		//cti.t2i.lv/zp_cti/request_log
		$this->basepath = $_SERVER['HTTP_HOST'].DIRECTORY_SEPARATOR.$folder;
		
		$this->checkFolderExists($this->basepath);
	}
	
	function logRequest($clientId, $type, $direction, $args = array()){
				
	}
	
	
	
	function checkFolderExists($folder){
		if (!file_exists($folder)) {
		    mkdir($folder, 0775, true);
			return 'folders created';
		}
	}
}
?>