<?php

class AuthModel extends BaseModel{

    const TABLE = 'ep_customer';
    var $tableName = self::TABLE;

    var $username;
    var $password;
    var $remember_ckb;
    var $id;


    public function updateField($data = [], $condition, $tableName) {
        return $this->updateData($data, $condition, $tableName);
    }
    public function store($data = [], $tableName) {
        return $this->insertData($data, $tableName);
    }
    public function check_name($condition, $tableName) {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>$tableName,
            'where' =>$condition
        ])->selectOne();
    }
    public function select_max($column, $tableName, $condition = '') {
        return $this->buildQueryParam([
            'select'=>"MAX($column) as $column",
            'from'  =>$tableName,
            'where' =>$condition
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
            "select"=>"id, username, password, cus_name, avatar, status",
            "from"  =>self::TABLE,
            "where"=>"username =:username",
            "params"=>[
                ":username"=>trim($this->username),
            ]
        ])->selectOne();
        if($result && $this->decodePassword($result['password'])){
            if(isset($result['status']) && $result['status']==1){
                $_SESSION['cus_id']   = $result['id'];
                $_SESSION['cus_name'] = $result['cus_name'];
                $_SESSION['avatar']   = $result['avatar'];
                if(!empty($this->remember_ckb)){
                    setcookie('username', $this->username, time()+3600*24*7);
                    setcookie('password', $this->password, time()+3600*24*7);
                    setcookie('remember_ckb', $this->password, time()+3600*24*7);
                }else{
                    setcookie('username', $this->username, 30);
                    setcookie('password', $this->password, 30);
                    setcookie('remember_ckb', $this->password, 30);
                }
                return true;
            }else{
                return 1; 
            }
        }
        return false;
    }
 

    public function logout() {
        if(isset($_SESSION['cus_id'])){
            unset($_SESSION['cus_id']);
            unset($_SESSION['cus_name']);
            unset($_SESSION['avatar']);
            unset($_SESSION['access_token']);
            unset($_SESSION['cart']);
            header('location: /Aquarium/views/frontend');
            exit;
        }
    }

    public function getSESSION($name) {
        if($name !== null) {
            return isset($_SESSION[$name]) ? $_SESSION[$name] : NULL;
        }
        return $_SESSION;
    }

    public function isLogin() {
        if ($this->getSESSION("cus_id")) {
            return true;
        }
        return false;
    }

    public function getId() {
        return $this->getSESSION("cus_id");
    }
    public function getUsername() {
        return $this->getSESSION("cus_name");
    }
}
 
