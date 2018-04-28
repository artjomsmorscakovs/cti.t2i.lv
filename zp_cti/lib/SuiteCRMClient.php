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

	public function createEntry($data){
	    //POST /api/v8/modules/{module}/{id}
	    $this->call("v8/modules/t2ilc_t2i_lmt_calls/",json_encode($data), "POST");
    }

    public function retrieveEntry($id){
        //GET /api/v8/modules/{module}/{id}
        $this->call("v8/modules/t2ilc_t2i_lmt_calls/",$id,"GET");
    }

    public function updateEntry($data){
	    //PATCH /api/v8/modules/{module}/{id}
	    $this->call("v8/modules/t2ilc_t2i_lmt_calls/",json_encode($data),"PATCH");
    }


    public function deleteEntry($id){
	    //DELETE /api/v8/modules/{module}/{id}
        $this->call("v8/modules/t2ilc_t2i_lmt_calls/",$id,"DELETE");
    }

	public function callMetaList(){
		$this->call('v8/modules/t2ilc_t2i_lmt_calls', json_encode(array()), 'GET');
	}


   //function to make cURL request
    function call($method, $parameters, $request = 'POST')
    {
    	$this->debugCRMParams($method, $parameters);

		$ch = curl_init();

		$url = 'https://crm1.t2i.lv/api/oauth/access_token';
		curl_setopt($ch, CURLOPT_URL, $this->url.$method);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
		if($request == 'POST'){
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
		$parameters = json_encode(array(
		    'grant_type' => 'password',
		    'client_id' => 'cab97968-8ff5-b655-9f5e-5ae2fd726492',
		    'client_secret' => 'd938225b-3177-5ec7-d356-5adde6e5ee3e',
		    'username' => 'admin',
		    'password' => 'T2I298220031',
		    'scope' => 'standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete'
		));

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