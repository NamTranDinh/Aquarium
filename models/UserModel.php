<?php

class UserModel extends BaseModel{
    
    const TABLE = 'ep_users';
    var $tableName = self::TABLE;
    var $username;
    var $password;
    var $id;

    public function checkPermission($id){
        return $this->buildQueryParam([
            'select'=>'group_permission',
            'from'  =>'ep_users_group',
            'where' =>'id = '.$id
        ])->selectOne();
    }

    public function encryptPassword() {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
    public function decodePassword($hash) {
        return password_verify($this->password, $hash);
    }

    public function login() {        
        $result = $this->buildQueryParam([
            "select"=>"id, username, password, name, group_id, status",
            "from"  =>self::TABLE,
            "where"=>"username =:username",
            "params"=>[
                ":username"=>trim($this->username),
            ]
        ])->selectOne();
        if($result && $this->decodePassword($result['password'])){
            if(isset($result['status']) && $result['status']==1){
                $_SESSION['userId'] = $result['id'];
                $_SESSION['username'] = $result['name'];
                $_SESSION['permission'] = $this->checkPermission($result['group_id'])['group_permission'];
                return true;
            }else{
                return 1; 
            }
        }
        return false;
    }
 

    public function logout() {
        if(isset($_SESSION['userId'])){
            unset($_SESSION['userId']);
            unset($_SESSION['username']);
            unset($_SESSION['permission']);
        }        
    }

    public function getSESSION($name) {
        if($name !== null) {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : NULL;
        }
        return $_SESSION;
    }

    public function isLogin() {
        if ($this->getSESSION("userId")) {
            return true;
        }
        return false;
    }

    public function getId() {
        return $this->getSESSION("userId");
    }
    public function getUsername() {
        return $this->getSESSION("username");
    }
}
?>