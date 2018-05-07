<?php
//DB MySQL Classes
require_once './MySQL/class.DBPDO.php';
//Define const for DB MySQL
define('DATABASE_NAME', 'cti_t2i_db');
define('DATABASE_USER', 'cti_t2i_u');
define('DATABASE_PASS', 'Fsc76s$1');
define('DATABASE_HOST', 'cti.t2i.lv');

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
	    $this->call("v8/modules/t2ilc_t2i_lmt_calls", $data);
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
		    $this->call("v8/modules/t2ilc_t2i_lmt_calls/".$this->id,$data,"PATCH");
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

		//FIXME Work is going here
        $DB = new DBPDO();
        //Receive ONE row from table tokens
        $output = $DB->fetch("SELECT * FROM tokens WHERE client_id = ?", $parameters['client_id']);
        if(isset($output) && !empty($output)){
            $today_dt = new DateTime();
            $expire_dt = new DateTime($output->expiration);
            if ($expire_dt < $today_dt) {
                //REFRESH ACCESS TOKEN
                $parameters = array(
                    'grant_type' => 'refresh_token',
                    'refresh_token'=>$output->refresh_token,
                    'client_id' => $output->client_id,
                    'client_secret' => $output->client_secret,
                    );
                //FIXME method seems to be wrong
                $response = $this->call('oauth/access_token', $parameters);
                $this->assignHeader($response);

                //Calculate DateTime when token will be expired
                $expiration = $this->calculateExpiration($response);

                //NOW WE HAVE TO UPDATE ROW to a new expiration value
                $DB->execute("UPDATE tokens SET access_token = ?, refresh_token = ?, expiration = ? WHERE cliend_id = ?",
                    array(
                        $response->access_token,
                        $response->refresh_token,
                        $expiration->format("Y-m-d H:i:s"),
                        $output->client_id,
                    )
                );
            } else {
                //GRAB TOKENS AND WORK WITH IT
                $this->assignHeader($output);
            }
        //If output is empty then do as request with pre-defined values
        }else {
            //Response + Header
            $response = $this->call('oauth/access_token', $parameters);
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
            );
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
     * @return DateTime
     * @throws Exception
     */
    private function calculateExpiration($response): DateTime
    {
        $expiration = new DateTime();
        $expiration->add(new DateInterval('PT' . $response->expires_in . 'S'));
        return $expiration;
    }
}

?>