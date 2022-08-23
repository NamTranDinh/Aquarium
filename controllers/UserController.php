<?php
if(session_id() == ''){
    //session has not started
    session_start();
}
class UserController extends BaseController {

    private $userModel;
    public function __construct() {
        $this->userModel = $this->load_model('UserModel');
    }

    public function index() {
        $error = '';
        $data = [];
        if($this->userModel->isLogin()){
            return $this->view('backend.dashboard.index');
        }
        if(isset($_POST['login'])){
            $this->userModel->username = $_POST['username'];
            $this->userModel->password = $_POST['password'];
            $data = $this->userModel->login();
            if($data===true){
                header("location: /Aquarium/views/backend/");
                return true;
            }elseif($data===1){
                $error = "Your account is locked!";
            }else {
                $error = "Username or password is incorrect.";
            }
        }
        return $this->view('backend.layouts.login', ['error'=>$error, 'dt'=>$data]);
    }

    public function logout() {
        $this->userModel->logout();
        header("location: /Aquarium/views/backend/?controller=user");
        // ob_end_flush();
    }
    
}

?>