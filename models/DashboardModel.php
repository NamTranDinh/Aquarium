<?php

class DashboardModel extends BaseModel{
    
    public function all_activity() {
        $today = date('Y-m-d');
        $sale_money = $this->buildQueryParam([
            'select' =>'SUM(b.number*b.price) as sale_money',
            'from'   =>'ep_event a',
            'join'   =>'JOIN ep_order_detail b on a.id = b.even_id 
                        JOIN ep_order c on b.order_id = c.id',
            'where'  =>'c.order_date > "'.$today.'"',
        ])->selectOne();
        $ord_product = $this->buildQueryParam([
            'select' => 'COUNT(b.id) as ord_product',
            'from'   => 'ep_order a ',
            'join'   => 'JOIN ep_order_detail b ON a.id = b.order_id',
            'where'  => 'order_date > "'.$today.'"',
        ])->selectOne();
        $data['sale_money'] = $sale_money['sale_money'];
        $data['order_num'] = $this->getCountRecord('ep_order', "order_date > '".$today."'");
        $data['ord_product'] = $ord_product['ord_product'];
        $data['order_cancel'] = $this->getCountRecord('ep_order', "order_date > '".$today."' and status = '0'");
        
        $data['event_left'] = $this->getCountRecord('ep_event', 'time_end > "'.$today.'"');
        $data['event_end'] = $this->getCountRecord('ep_event', 'time_end < "'.$today.'"');
        $data['event_almostOver'] = $this->getCountRecord('ep_event', 'time_end < "'.date('Y-m-d', strtotime('+1 week')).'" and time_end > "'.$today.'"');
        $data['event_soldOut'] = $this->getCountRecord('ep_event', 'ticket_num <= "0"');
        
        $data['new_mem'] = $this->getCountRecord('ep_customer', 'created > "'.$today.'"');
        $data['new_post'] = $this->getCountRecord('ep_sea_animal', 'created > "'.$today.'"');
        $data['new_event'] = $this->getCountRecord('ep_event', 'created > "'.$today.'"');
        $data['new_feedBack'] = 0;
        $data['new_contact'] = 0;

        return $data;
    }

    public function getSales($condition = '1') {
        return $this->buildQueryParam([
            'select' => 'SUM(a.total_money) as total_all',
            'from'   => '(SELECT SUM(a.number*a.price) as total_money
                            FROM ep_order_detail a 
                            JOIN ep_order b on a.order_id = b.id
                            WHERE '.$condition.' and status not in(-1, 0) GROUP BY a.even_id) a ',//and b.status = 3
        ])->selectOne();
    }
  
}