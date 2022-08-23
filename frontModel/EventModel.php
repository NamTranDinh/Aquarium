<?php 

class EventModel extends BaseModel{

    public function findAny($column = ['*'], $condition = '', $tableName) {
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => $tableName,
            'where' => $condition
        ])->select();
    }

    public function getEventDetail($id, $column = ['*']) {
        $condition = 'id in ('.$id.') and status = 1';
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => 'ep_event',
            'where' => $condition,
            'order by' => 'id'
        ])->select();
    }
    public function getEventDescription($condition) {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_even_description',
            'where' =>$condition
        ])->select();
    }

    public function getEventData($limit, $offset, $condition) {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'id, event_name, event_sub_img',
            'from'  =>'ep_event',
            'where' =>$condition,
            'other' =>$other
        ])->select();
    }
    // comment
    public function getComment_event($limit, $offset, $condition = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.id, a.customer_id, comment, a.created, b.cus_name, b.avatar',
            'from'  =>'ep_feedback a',
            'join'  =>'JOIN ep_customer b on a.customer_id = b.id',
            'where' =>$condition,
            'order by' =>'a.created desc',
            'other' =>$other,
        ])->select();
    }
}