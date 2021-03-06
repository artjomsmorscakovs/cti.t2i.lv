<?php
//DB MySQL Classes
require_once 'MySQL/class.DBPDO.php';
//Define const for DB MySQL
define('DATABASE_NAME', 'cti_t2i_db');
define('DATABASE_USER', 'cti_t2i_u');
define('DATABASE_PASS', 'Fsc76s$1');
define('DATABASE_HOST', 'localhost:3306');

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
	var $debugAPIheaders = FALSE;
	
	function __construct($contactid = '969'){
		$this->connect($contactid);
		//Uncomment callMetaList() to see details about module t2ilc_t2i_lmt_calls
		//$this->callMetaList();
	}

/**
 * Important to NOT use "/" Slash in the end, otherwise it won`t create any record 
 */
	public function createEntry($data){
	    //POST /api/v8/modules/{module}/{id}
	    return $this->call("v8/modules/t2ilc_t2i_lmt_calls", $data);
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
    	
		$this->debugAPIheaders($method);
		
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

	private function connect($contactid){

/*
		$parameters = array(
		    'grant_type' => 'password',
		    'client_id' => 'cab97968-8ff5-b655-9f5e-5ae2fd726492',
		    'client_secret' => 'd938225b-3177-5ec7-d356-5adde6e5ee3e',
		    'username' => 'admin',
		    'password' => 'T2I298220031',
		    'scope' => 'standard:create standard:read standard:update standard:delete standard:delete standard:relationship:create standard:relationship:read standard:relationship:update standard:relationship:delete'
		);*/


		//FIXME Work is going here
        $DB = new DBPDO();
        //Receive ONE row from table tokens
        $output = $DB->fetch("SELECT * FROM tokens WHERE contactid = ?", $contactid);
        if(isset($output) && !empty($output)){
            echo "<h1>OUTPUT IS NOT NULL</h1>";
			$this->url = $output['url'];
            //print_r($output);
            $today_dt = new DateTime();
            $expire_dt = new DateTime($output['expiration']);
            if ($expire_dt->format("Y-m-d H:i:s") < $today_dt->format("Y-m-d H:i:s")) {
                echo "REFRESH ACCESS TOKEN";
                
                $parameters = array(
                                    'grant_type' => 'password',
                                    'client_id' => $output['client_id'],
                                    'client_secret' => $output['client_secret'],
                                    'username' => $output['username'],
                                    'password' => $output['password'],
                                    'scope' => $output['scope'],
                                    );
                
                //FIXME method seems to be wrong
                $response = $this->call('oauth/access_token', $parameters);

                //Calculate DateTime when token will be expired
                $expiration = $this->calculateExpiration($response);

                //NOW WE HAVE TO UPDATE ROW to a new expiration value
                //print_r($response);
                $DB->execute("UPDATE tokens SET access_token = ?, refresh_token = ?, expiration = ? WHERE contactid = ? ",
                    array(
	                    $response->access_token,
	                    $response->refresh_token,
	                    $expiration->format("Y-m-d H:i:s"),
                       	$output['contactid'],
                    )
                );
				$this->assignHeader($response);
            } else {
                echo "GRAB TOKENS AND WORK WITH IT";
                $this->assignHeaderArray($output);
            }
        //If output is empty then do as request with pre-defined values
        }else {
        	//AM I THINK HERE SHOULD BE ERROR, BECAUSE WE ARE NOT ALLOWED TO PUSH CONTACTS WHICH ARE NOT IN OUR DB
 /*
            //Response + Header
             $response = $this->call('oauth/access_token', $parameters);
             print_r($response);
             $this->assignHeader($response);
             //Calculate DateTime when token will be expired
             $expiration = $this->calculateExpiration($response);
             //Add row to table tokens
             $DB->execute("INSERT INTO tokens (client_id,client_secret,scope,access_token,refresh_token,expiration) VALUES(?,?,?,?,?,?);",array(
                 $parameters['client_id'],
                 $parameters['client_secret'],
                 $parameters['scope'],
                 $response->access_token,
                 $response->refresh_token,
                 $expiration->format("Y-m-d H:i:s")
                 )
             );*/
             
 
        }
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
	
	private function debugAPIheaders($method){
		if($this->debugAPIheaders){			
			echo "Method Headers: $method \n";
			echo "<pre>";
			print_r($this->header);
		    echo "</pre>";			
		}
	}	

    /**
     * @param $response
     */
    private function assignHeader($response)
    {
        $this->access_token = $response->access_token;
        $this->refresh_token = $response->refresh_token;
        $this->header = array(
            'Content-type: application/vnd.api+json',
            'Accept: application/vnd.api+json',
            'Authorization: Bearer ' . $this->access_token,
        );
    }
	
    /**
     * @param $response
     */
    private function assignHeaderArray($response)
    {
        $this->access_token = $response['access_token'];
        $this->refresh_token = $response['refresh_token'];
        $this->header = array(
            'Content-type: application/vnd.api+json',
            'Accept: application/vnd.api+json',
            'Authorization: Bearer ' . $this->access_token,
        );
    }	

    /**
     * @param $response
     * @return DateTime
     * @throws Exception
     */
    private function calculateExpiration($response)
    {
        $expiration = new DateTime();
        $expiration->add(new DateInterval('PT' . $response->expires_in . 'S'));
        return $expiration;
    }
}

?>