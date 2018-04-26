<?php
class CallStartedEvent{
	public  $type;
	public  $eventType;
	public  $version;
	public  $data;
	public  $datetime;
	
	public function setData($data){
		$this->data = $data;
		$this->datetime = $data->callStarted;
	}
}

?>