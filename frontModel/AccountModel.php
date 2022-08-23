<?php

class AccountModel extends BaseModel{
    
    public function getDataUser($condition) {
        return $this->buildQueryParam([
            'select'=>'id, username, cus_name, gender, datebirth, phone, email, address, avatar',
            'from'=>'ep_customer',
            'where'=>$condition,
        ])->select();
    }
}