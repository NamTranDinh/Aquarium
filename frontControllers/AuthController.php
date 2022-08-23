<?php

class AuthController extends BaseController{

    private $authModel;

    public function __construct() {
        $this->authModel = $this->load_model_public('AuthModel');
    }

    public function index() { 
        require_once BASE_PATH."/system/API/google_source.php";
        if(!isset($authUrl)){
            $googleUser = $service->userinfo->get(); //get user info 
            $data['cus_name']= $googleUser['name'];
            $data['username'] = $data['email'] = $googleUser['email'];
            $data['avatar']  = $googleUser['picture'];
            $condition = 'username = "'.$data['username'].'" and cus_name = "'.$data['cus_name'].'"';
            $find = $this->authModel->check_name($condition, AuthModel::TABLE);
            if(count($find) == 0) {
                $condition1 = 'customer_code like "%KH%"';
                $max_event_code = $this->authModel->select_max('customer_code', AuthModel::TABLE, $condition1);
                $max_code = (int)(str_replace('KH', '', $max_event_code['customer_code'])) + 1;
                if ($max_code < 10)
                    $data['customer_code'] = 'KH00000' . ($max_code);
                else if ($max_code < 100)
                    $data['customer_code'] = 'KH0000' . ($max_code);
                else if ($max_code < 1000)
                    $data['customer_code'] = 'KH000' . ($max_code);
                else if ($max_code < 10000)
                    $data['customer_code'] = 'KH00' . ($max_code);
                else if ($max_code < 100000)
                    $data['customer_code'] = 'KH0' . ($max_code);
                else if ($max_code < 1000000)
                    $data['customer_code'] = 'KH' . ($max_code);
                $this->authModel->store($data, AuthModel::TABLE);
            }
            $data = $this->authModel->check_name($condition, AuthModel::TABLE);
            
            $_SESSION['cus_id']   = $data['id'];
            $_SESSION['cus_name'] = $data['cus_name'];
            $_SESSION['avatar']   = $data['avatar'];
           
        }
        $error = '';
        $data = [];
        if($this->authModel->isLogin()){
            if(isset($_COOKIE['redirect_url'])){
                header("location: ".$_COOKIE['redirect_url']);
                setcookie('redirect_url', '', 1);
            }else{
                header("location: /Aquarium/views/frontend/");
            }
            exit();
        }
        if(isset($_POST['login'])){
            $this->authModel->username = $_POST['username'];
            $this->authModel->password = $_POST['password'];
            if(!empty($_POST['remember_ckb'])){
                $this->authModel->remember_ckb = $_POST['remember_ckb'];
            }
            $data = $this->authModel->login();
            if($data===true){
                if(isset($_COOKIE['redirect_url'])){
                    header("location: ".$_COOKIE['redirect_url']);
                    setcookie('redirect_url', '', 1);
                }else{
                    header("location: /Aquarium/views/frontend/");
                }
                return true;
            }elseif($data===1){
                $error = "Your account is locked!";
            }else {
                $error = "Username or password is incorrect.";
            }
        }
        return $this->view('frontend.auth.login', [
            'error'=>$error,
            'authUrl'=>$authUrl??''
        ]);
    }

    public function logout() {
        $this->authModel->logout();
        header("location: /Aquarium/views/frontend/");
    }
 
}