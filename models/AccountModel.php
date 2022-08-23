<?php

class AccountModel extends BaseModel{
    const TABLE = 'ep_users';
    var $tableName = self::TABLE;
    public function getDataAccount($id) {
        return $this->buildQueryParam([
            'select'=>'a.*, group_name, group_permission',
            'from'  =>self::TABLE.' a',
            'join'  =>'join ep_users_group b on a.group_id = b.id',
            'where' =>'a.id = '.$id
        ])->selectOne();
    }
    public function isPassword($id, $pass = '') {
        $data = $this->buildQueryParam([
            'select'=>'password',
            'from'  =>self::TABLE,
            'where' =>"id = $id"
        ])->selectOne();
        if(count($data)==1 && password_verify($pass, $data['password'])){
            return true;
        }
        return false;
    }    
    public function changePassword($id, $pass) {
        $data['password'] = password_hash($pass, PASSWORD_DEFAULT);
        $condition = "id = '".$id."'";
        return $this->updateData($data, $condition, self::TABLE);
    }

}
 