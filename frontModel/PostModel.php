<?php

class PostModel extends BaseModel{

    public function findAny($column = ['*'], $condition = '', $tableName) {
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => $tableName,
            'where' => $condition
        ])->select();
    }

    public function get_category_data() {
        return $this->all(['id', 'group_name', 'parent_id'], 'ep_sea_group');
    }

    public function getPostData($condition = ''){
        return $this->buildQueryParam([
            'select'=>'sea_id, sea_name, sea_img, sea_sub_img, sea_info, b.group_name, c.name, a.created, a.status',
            'from'  =>'ep_sea_animal a',
            'join'  =>'JOIN ep_sea_group b on a.sea_group_id = b.id LEFT JOIN ep_users c on a.user_id = c.id',
            'where' => $condition,
        ])->selectOne();
    }
 
    public function getPostDescription($condition) {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_sea_description',
            'where' => $condition
        ])->select();
    }

    public function getAnimalGuideData($limit = 0, $offset = 0, $condition = '1') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'sea_id, sea_name, sea_sub_img, group_name',
            'from'  =>'ep_sea_animal a',
            'join'  =>'JOIN ep_sea_group b on a.sea_group_id = b.id',
            'where' => $condition.' and a.status = 1',
            'other' => $other
        ])->select(); 
    }
}