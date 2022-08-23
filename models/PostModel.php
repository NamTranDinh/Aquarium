<?php

class PostModel extends BaseModel{


    public function findField($column = ['*'], $tableName, $limit = 25, $offset = 0, $condition = '') {
        return $this->all($column, $tableName, $limit, $offset, $condition);
    }

    public function findAny($column = ['*'], $condition = '', $tableName) {
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => $tableName,
            'where' => $condition
        ])->select();
    }

    public function getPostData($limit = 0, $offset = 0){
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'sea_id, sea_name, sea_img, sea_info, b.group_name, c.name, a.created, a.status',
            'from'  =>'ep_sea_animal a',
            'join'  =>'JOIN ep_sea_group b on a.sea_group_id = b.id LEFT JOIN ep_users c on a.user_id = c.id',
            'other' => $other
        ])->select();
    }

    public function getPostGrData($limit = 0, $offset = 0, $condition = ''){
        // $sql = "SELECT a.id, a.group_name, parent_name, created, status FROM ep_sea_group a LEFT JOIN (SELECT c.id, parent_name FROM ep_sea_group c JOIN (SELECT id , group_name as parent_name FROM ep_sea_group) d on c.parent_id = d.id) b on a.id = b.id";
        // return $this->defaultQuery($sql, 'select');
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.id, a.group_name, a.parent_id, parent_name, created, status',
            'from'  =>'ep_sea_group a',
            'join'  =>'LEFT JOIN (SELECT c.id, parent_name FROM ep_sea_group c JOIN (SELECT id , group_name as parent_name FROM ep_sea_group) d on c.parent_id = d.id) b on a.id = b.id',
            'where' => $condition,
            'other' => $other
        ])->select();
    }

    public function get_category_data() {
        return $this->all(['id', 'group_name', 'parent_id'], 'ep_sea_group');
    }

}