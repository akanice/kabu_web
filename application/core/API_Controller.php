<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class API_Controller extends MX_Controller {
    
    protected $user;
    
	public function __construct() {
        parent::__construct();
        if($this->uri->segment(2) != "login" && $this->uri->segment(2) != "register") {
            $this->parseJWT();
        }
		
    }

    public function createToken($user) {
        $token = array(
            "user" => $user,
            "expired" => time() + 30*24*60*60
        );

        return JWT::encode($token, $this->config->item('jwt_key'));
    }
    
    public function parseJWT() {
        $headers = $this->input->request_headers();
        if(!isset($headers['Authorization'])) {
            $this->return(401);
        }

        $token = str_replace("Bearer", '', $headers['Authorization']);
        if(!$token || $token == "") {
            $this->return(401);
        }
        
        try {
            $token = trim($token);
            $decoded = JWT::decode($token, $this->config->item('jwt_key'), array('HS256'));
            
            if($decoded->expired < time()) {
                $this->return(401);
            }

            $this->user = $decoded->user;
        }
        catch(Exception $ex) {
            $this->return(401);
        }
    }

    public function returnJson($input) {
        exit(json_encode($input));
    }

    public function return($status = 401, $message = 'Unauthorized') {
        http_response_code($status);
        exit($message);
    }

    public function _password_encrypt($email='',$password=''){
        $str = $password;
        // for ($i=0;$i<(100+strlen($email));$i++){
            // $str = md5($email.'|'.$str);
        // }
		for($i = 0; $i < 50; $i++){
			$str = md5($str);
		}
        return $str;
    }
}

?>
