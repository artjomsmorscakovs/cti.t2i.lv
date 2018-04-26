<?php

class RequestFileLog {
	private $basepath;
	
	function __construct(){
		//cti.t2i.lv/zp_cti/request_log
	}
	
	function logRequest(Event $request){
		$this->checkFolderExists($request->getFolderPath());
		
		$this->log($this->basepath.$request->getFileName(), print_r(get_object_vars($request),TRUE));
	}
	
	
	private function checkFolderExists($folder){
		$this->basepath = $_SERVER[ 'DOCUMENT_ROOT' ].DIRECTORY_SEPARATOR.$folder;
		
		if (!file_exists($this->basepath)) {
		    mkdir($this->basepath, 0775, true);
		}
	}
	
	private function log($file, $string_data){
		
		file_put_contents($file, $string_data);
	}
}
?>