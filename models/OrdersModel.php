<?php

class OrdersModel extends BaseModel {
 
    public function getDataOrder($limit = 0, $offset = 0, $condition = '', $having = '', $order_by = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.*, order_code , d.cus_name, b.name as method_name, SUM(c.number*c.price) as total_money',
            'from'  =>'ep_order a',
            'join'  =>'JOIN ep_order_method b on a.order_method_id = b.id 
                       JOIN ep_order_detail c on a.id = c.order_id
                       JOIN ep_customer d on a.customer_id = d.id',
            'where' =>$condition,
            'group by' => 'a.id',
            'having'   => $having,
            'order by' => $order_by,
            'other'    => $other,
        ])->select();
    }

    public function getDataOdrNotice($limit = 0, $offset = 0, $condition = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.id, order_code, check_view, order_date, cus_name',
            'from'  =>'ep_order a',
            'join'  =>'JOIN ep_customer b on a.customer_id = b.id',
            'where' =>$condition,
            'order by' => 'order_date desc',
            'other'    => $other,
        ])->select();
    }
 
    public function getDataOdrDetail($order_id) {
        return $this->buildQueryParam([
            'select'=>'a.id, event_code, b.event_name, a.type, a.number, a.price , a.number*a.price as total_money',
            'from'  =>'ep_order_detail a ',
            'join'  =>'JOIN ep_event b on a.even_id = b.id',
            'where' =>'a.order_id = "'.$order_id.'"',
        ])->select();
    }
  
    
 

}