<?php

class CustomerModel extends BaseModel{
    
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

    public function getCustomerData($limit = 0, $offset = 0, $condition = '', $having = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        $cus_column = $this->ColumnList('ep_customer');
        $cus_column['id'] = 'a.id';
        unset($cus_column['password']);
        unset($cus_column['updated']);
        $column = implode(', a.', $cus_column);
        return $this->buildQueryParam([
            'select'=> $column.' , MAX(b.order_date) as last_purchase, SUM(c.number*c.price) as total_money',
            'from'  => 'ep_customer a',
            'join'  => 'LEFT JOIN ep_order b on a.id = b.customer_id 
                       LEFT JOIN ep_order_detail c on b.id = c.order_id',
            'where' => $condition,
            'group by'=> 'a.id',
            'having'=> $having,
            'other' => $other
        ])->select();
    }

    public function getTotalAll() {
        return $this->buildQueryParam([
            'select'=> 'SUM(c.number*c.price) as total_money',
            'from'  => 'ep_customer a',
            'join'  => 'JOIN ep_order b on a.id = b.customer_id 
                       JOIN ep_order_detail c on b.id = c.order_id',
        ])->selectOne()['total_money'];
    }
  
}