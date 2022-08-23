<?php

class ContactModel extends BaseModel{
    public function getContactData($limit = 0, $offset = 0, $condition = '')
    {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=> '*',
            'from'  => 'ep_contact',
            'where' => $condition,
            'other' => $other,
        ])->select();
    } 
    public function findField($column = ['*'], $tableName, $limit = 25, $offset = 0, $condition = '') {
        return $this->all($column, $tableName, $limit, $offset, $condition);
    }
}