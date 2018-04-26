<?php

class RequestFileLog {
	private $basepath;
	
	function __construct($folder){
		//cti.t2i.lv/zp_cti/request_log

		
		$this->checkFolderExists($this->basepath);
	}
	
	function logRequest($request){
		
	}
	
	
	
	private function checkFolderExists($folder){
		$this->basepath = $_SERVER[ 'DOCUMENT_ROOT' ].DIRECTORY_SEPARATOR.$folder;
		
		if (!file_exists($this->basepath)) {
		    mkdir($this->basepath, 0775, true);
			return 'folders created';
		}
	}
}
?>