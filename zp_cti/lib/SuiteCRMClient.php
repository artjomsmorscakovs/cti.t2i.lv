<?php
class SuiteCRMClient{
	
	var $url = 'https://crm1.t2i.lv/api/';
	var $header = array(
		    'Content-type: application/vnd.api+json',
		    'Accept: application/vnd.api+json',
		 );
	var $access_token;
	var $refresh_token;
	var $debugCRMcalls = TRUE;
	var $debugCRMparams = TRUE;
	
	function __construct(){
		$this->connect();
		//Uncomment callMetaList() to see details about module t2ilc_t2i_lmt_calls
		//$this->callMetaList();
	}

/**
 * Important to NOT use "/" Slash in the end, otherwise it won`t create any record 
 */
	public function createEntry($data){
	    //POST /api/v8/modules/{module}/{id}
	    return $this->call("v8/modules/t2ilc_t2i_lmt_calls", $data); //json_encode required here
    }

    public function retrieveEntry($data){
    	//GET /api/v8/modules/{module}/{id}
		if($this->getDataId($data)){
			return $this->call("v8/modules/t2ilc_t2i_lmt_calls/".$this->id,array(),"GET");
		}else return FALSE;    	
    }

    public function updateEntry($data){
	    //PATCH /api/v8/modules/{module}/{id}
		if($this->getDataId($data)){
			return $this->call("v8/modules/t2ilc_t2i_lmt_calls/".$this->id,$data,"PATCH");
		}else return FALSE;    		    
    }

    public function deleteEntry($data){
	    //DELETE /api/v8/modules/{module}/{id}
		if($this->getDataId($data)){
			return $this->call("v8/modules/t2ilc_t2i_lmt_calls/".$this->id,array(),"DELETE");
		}else return FALSE;	    
	    
    }
	
	private function getDataId($parameters){
		if(isset($parameters['data']['id']) && !empty($parameters['data']['id'])){
			$this->id = $parameters['data']['id'];
			return TRUE;
		}else return FALSE;  		
	}

	public function callMetaList(){
		return $this->call('v8/modules/t2ilc_t2i_lmt_calls', json_encode(array()), 'GET');
	}

    public function findByCall_ID($call_id){
        return $this->call('v8/modules/t2ilc_t2i_lmt_calls?filter[t2ilc_t2i_lmt_calls.callid]=[[eq]]'.$call_id, array(), 'GET');
    }

   //function to make cURL request
    function call($method, $parameters, $request = 'POST')
    {
    	$this->debugCRMParams($method, $parameters);
		
		$url = $this->url.$method;
		
		$ch = curl_init();

		
		$parameters = json_encode($parameters);
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
		if($request == 'POST' || $request == 'PATCH'){
			//curl_setopt($ch, CURLOPT_URL, $this->url.$method);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
		$output = curl_exec($ch);

		$response = json_decode($output);

		$this->debugCRMCalls($method, $response);

		return $response;
    }

	private function connect(){
		$parameters = array(
		    'grant_type' => 'password',
		    'client_id' => 'cab97968-8ff5-b655-9f5e-5ae2fd726492',
		    'client_secret' => 'd938225b-3177-5ec7-d356-5adde6e5ee3e',
		    'username' => 'admin',
		    'password' => 'T2I298220031',
		    'scope' => 'standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete'
		);

		$response = $this->call('oauth/access_token', $parameters);

		$this->access_token = $response->access_token;
		$this->refresh_token = $response->refresh_token;
		$this->header = array(
		    'Content-type: application/vnd.api+json',
		    'Accept: application/vnd.api+json',
		    'Authorization: Bearer '.$this->access_token,
		 );
	}
	
	private function debugCRMCalls($method, $result){
		if($this->debugCRMcalls){			
			echo "Method Result: $method \n";
			echo "<pre>";
			print_r($result);
		    echo "</pre>";			
		}
	}
	
	private function debugCRMParams($method, $params){
		if($this->debugCRMparams){			
			echo "Method Params: $method \n";
			echo "<pre>";
			print_r($params);
		    echo "</pre>";			
		}
	}	
}

?>