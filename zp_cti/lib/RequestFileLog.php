<?php

class RequestFileLog {
	private $basepath;
	
	function __construct($folder){
		//cti.t2i.lv/zp_cti/request_log

		
		$this->checkFolderExists($this->basepath);
	}
	
	function logRequest(Event $request){
		$this->checkFolderExists($request->folderpath);
		$arrdata = (array) $request;
		if(is_array($arrdata)){
			$this->log($this->basepath.$request->filename, print_r($string_data,TRUE));
		}
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