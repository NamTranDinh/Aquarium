<?php

class EventModel extends BaseModel{
    
    public function findAny($column = ['*'], $condition = '', $tableName) {
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => $tableName,
            'where' => $condition
        ])->select();
    }

    public function getEventData($limit = 0, $offset = 0, $condition = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_event',
            'where' =>$condition,
            'order by' =>'event_code asc',
            'other' =>$other
        ])->select();
    }

}