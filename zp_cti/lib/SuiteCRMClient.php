<?php
class SuiteCRMClient{
	
	var $url = 'https://crm1.t2i.lv/api/';
	var $header = array(
		    'Content-type: application/vnd.api+json',
		    'Accept: application/vnd.api+json',
		 );
	var $access_token;
	var $refresh_token;
	var $debugCRMcalls = FALSE; //FIXME Change back to TRUE
	var $debugCRMparams = FALSE;//FIXME Change back to TRUE
	
	function __construct(){
		$this->connect();
		//Uncomment callMetaList() to see details about module t2ilc_t2i_lmt_calls
		//$this->callMetaList();
	}

	public function createEntry($data){
	    //POST /api/v8/modules/{module}/{id}
	    $this->call("v8/modules/t2ilc_t2i_lmt_calls/",json_encode($data), "POST"); //json_encode required here
    }

    public function retrieveEntry($id){
        //GET /api/v8/modules/{module}/{id}
        $this->call("v8/modules/t2ilc_t2i_lmt_calls/",$id,"GET");
    }

    public function updateEntry($data){
	    //PATCH /api/v8/modules/{module}/{id}
	    $this->call("v8/modules/t2ilc_t2i_lmt_calls/",$data,"PATCH"); //json_encode will be executed in call()
    }


    public function deleteEntry($id){
	    //DELETE /api/v8/modules/{module}/{id}
        $this->call("v8/modules/t2ilc_t2i_lmt_calls/",$id,"DELETE");
    }

	public function callMetaList(){
		$this->call('v8/modules/t2ilc_t2i_lmt_calls', json_encode(array()), 'GET');
	}

    public function findByCall_ID($id){
        $output = $this->call('v8/modules/t2ilc_t2i_lmt_calls', '', 'GET');
        foreach ($output->data as $call) {
            $call_id = $call->attributes->callid;
            if ($id == $call_id) {
                echo '<h1>UPDATES ENTRY</h1>';
                print_r($call->id);
                return $call->id;
            }
        }
        echo '<h1>CREATES ENTRY</h1>';
        return FALSE;
    }

   //function to make cURL request
    function call($method, $parameters, $request = 'POST')
    {
    	$this->debugCRMParams($method, $parameters);

		$ch = curl_init();

		//FIXME unused variabe $url
		$url = 'https://crm1.t2i.lv/api/oauth/access_token';

		curl_setopt($ch, CURLOPT_URL, $this->url.$method);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request);
		if($request == 'POST'){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
		}
		if($request == 'GET'){
		    //TODO How to add to existing url, not creating a new?
            curl_setopt($ch, CURLOPT_URL, $this->url.$method.$parameters); //Here $parameters is the id itself
        }
        if($request == 'PATCH'){
		    //TODO I feel there is something wrong with logic, but it works
            curl_setopt($ch, CURLOPT_URL, $this->url.$method.$parameters['data']['id']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        }
        if($request == 'DELETE'){
            curl_setopt($ch, CURLOPT_URL, $this->url.$method.$parameters); //Here $parameters is the id itself
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