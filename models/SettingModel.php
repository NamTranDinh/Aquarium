<?php

class SettingModel extends BaseModel{

    const TABLE = 'ep_users';
    var $tableName = self::TABLE;

    public function getUserData($limit = 25, $offset = 0) {
        return $this->buildQueryParam([
            'select'=>'a.*, group_name, group_permission',
            'from'  =>self::TABLE.' a',
            'join'  =>'join ep_users_group b on a.group_id = b.id',
            'other' =>"limit $limit offset $offset"
        ])->select();
    }
    public function getUserGroupData($limit = 25, $offset = 0) {
        return $this->buildQueryParam([
            'select'=>'a.*, count(b.group_id) as count',
            'from'  =>'ep_users_group a',
            'join'  =>'left join '.self::TABLE.' b on a.id=b.group_id',
            'group by'=>'id, group_id',
            'order by'=>'id',
            'other' =>"limit $limit offset $offset"
        ])->select();
    }
    public function countUser() {
        return $this->getCountRecord(self::TABLE);
    }
    public function countGroupUser() {
        return $this->getCountRecord('ep_users_group');
    }
     
}