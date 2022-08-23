<?php

class SearchModel extends BaseModel{
   
    public function findAny($column = ['*'], $condition = '', $tableName) {
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => $tableName,
            'where' => $condition
        ])->select();
    }

    public function getDataSearch($limit = 0, $offset = 0, $condition = '', $animal_condition = ''){
        if($limit>0 || $offset>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'*',
            'from'=>'(SELECT id, event_name as name, event_sub_img as img, event_intro as excerpt, created, status as event, 0 as posts 
                        from ep_event 
                        where status = 1
                    UNION ALL
                    SELECT sea_id as id, sea_name as name, sea_sub_img as img, sea_info as excerpt, created, 0 as event, status as posts 
                        from ep_sea_animal 
                        where status = 1 '.$animal_condition.') as sub',
            'where'=>$condition,
            'order by'=>'created desc',
            'other'=>$other,
        ])->select();
    }
}

    