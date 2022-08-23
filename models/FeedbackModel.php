<?php

class FeedbackModel extends BaseModel{
    public function getFeedbackData($limit = 0, $offset = 0, $condition = '')
    {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select' => 'fb.id, ev.event_name, us.cus_name, comment, fb.created, fb.status',
            'from'   => 'ep_feedback fb',
            'join'   => 'JOIN ep_event ev on fb.event_id = ev.id JOIN ep_customer us on fb.customer_id = us.id',
            'where'  => $condition,
            'other'  => $other 
        ])->select();
    }
    
}