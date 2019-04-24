<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Login extends API_Controller {

    function __construct() {
        parent::__construct();
    }

    function me() {
        var_dump($this->user);
    }

    function facebook() {
        $fb = new \Facebook\Facebook([
            'app_id' => $this->config->item('facebook_app_id'),
            'app_secret' => $this->config->item('facebook_app_secret'),
            'default_graph_version' => 'v2.10'
          ]);
        try {
            $response = $fb->get('/me', $this->input->post('access_token'));
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            $this->return(401);
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            $this->return(401);
        }
        
        $me = $response->getGraphUser();
        var_dump($me);
        echo 'Logged in as ' . $me->getName();
    }

    function regular() {
        if($this->input->post('email') && $this->input->post('password')){
            $email = $this->input->post('email');
            $email = $this->db->escape_str($email);
            $pass = $this->input->post('password');
            $this->load->model('usersmodel');
            $userdata = $this->usersmodel->read(array('email'=>$email),array(),true);
            if($userdata){
                for($i = 0; $i < 50; $i++){
                    $pass = md5($pass);
                }
                if($pass === $userdata->password){
             
                    unset($userdata->password);
                    
                    $this->returnJson([
                        'success' => true,
                        'message' => 'successful',
                        'token' => $this->createToken($userdata)
                    ]);
                }
            }
        }
        $this->returnJson([
            'success' => false,
            'message' => 'wrong email or password'
        ]);
    }

    function register() {
        $email = $this->input->post('email');
        $email = $this->db->escape_str($email);

        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) || !$password) {
            $this->returnJson([
                'success' => false,
                'message' => 'missing email or password'
            ]);
        }

        $this->load->model('usersmodel');
        $userdata = $this->usersmodel->read(array('email'=>$email),array(),true);
        
        
        if($userdata){
            $this->returnJson([
                'success' => false,
                'message' => 'Email đã tồn tại'
            ]);
        } else {
            $data = array(
                "name" 					=> $name ? $name : '',
                "email"						=> $email,
                "phone" 					=> $phone ? $phone : '',
                "address" 				=> $address ? $address : '',
                "city" 						=> '',
                "password" 				=> $this->_password_encrypt($email, $password),
                "user_code" 			=> generateUserCode($length=8),
                "role" 						=> 'normal',
                "create_time" 			=> time(),
            );
            
            $user_id = $this->usersmodel->create($data);
            $this->load->model('affiliatesmodel');
            $this->affiliatesmodel->createNewAffiliateUser($user_id);

            $userdata = $this->usersmodel->read(array('email'=>$email),array(),true);
            unset($userdata->password);

            $this->returnJson([
                'success' => true,
                'message' => 'Successful',
                'token' => $this->createToken($userdata)
            ]);
        }
    }
}
