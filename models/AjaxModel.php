<?php

class AjaxModel extends BaseModel{

    public function destroy($condition, $tableName) {
        return $this->deleteData($condition, $tableName);
    }
    public function updateField($data = [], $condition, $tableName) {
        return $this->updateData($data, $condition, $tableName);
    }
    public function store($data = [], $tableName) {
        return $this->insertData($data, $tableName);
    }
    public function findField($column = ['*'], $tableName, $limit = 999, $offset = 0, $condition = '') {
        return $this->all($column, $tableName, $limit, $offset, $condition);
    }
    public function findAny($column = ['*'], $condition = '', $tableName) {
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => $tableName,
            'where' => $condition
        ])->select();
    }
    public function check_name($condition, $tableName) {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>$tableName,
            'where' =>$condition
        ])->selectOne();
    }
    public function select_max($column, $tableName, $condition = '') {
        return $this->buildQueryParam([
            'select'=>"MAX($column) as $column",
            'from'  =>$tableName,
            'where' =>$condition
        ])->selectOne();
    }
    // ============ SETTING ============
    
    public function getUserData($limit = 0, $offset = 0) {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.*, group_name, group_permission',
            'from'  =>'ep_users a',
            'join'  =>'join ep_users_group b on a.group_id = b.id',
            'other' =>$other,
        ])->select();
    }
    public function getUserGroupData($limit = 0, $offset = 0) {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.*, count(b.group_id) as count',
            'from'  =>'ep_users_group a',
            'join'  =>'left join ep_users b on a.id=b.group_id',
            'group by'=>'id, group_id',
            'order by'=>'id',
            'other' =>$other,
        ])->select();
    }
    public function countUser() {
        return $this->getCountRecord('ep_users');
    }    
    public function countGroupUser() {
        return $this->getCountRecord('ep_users_group');
    }
    
    // =========== POSTS =============

    public function getPostData($limit = 0, $offset = 0, $condition = '', $order_by=''){
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'sea_id, sea_name, sea_img, sea_sub_img, sea_info, b.group_name, c.name, a.created, a.status',
            'from'  =>'ep_sea_animal a',
            'join'  =>'JOIN ep_sea_group b on a.sea_group_id = b.id LEFT JOIN ep_users c on a.user_id = c.id',
            'where' => $condition,
            'order by' => $order_by,
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
            'join'  =>'LEFT JOIN (SELECT c.id, parent_name FROM ep_sea_group c JOIN (SELECT id , group_name as parent_name FROM ep_sea_group) d on c.parent_id = d.id) b on a.id = b.id ',
            'where' => $condition,
            'other' => $other
        ])->select();
    }

   
    public function getPostDescription($condition) {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_sea_description',
            'where' => $condition
        ])->select();
    }

    public function get_category_data() {
        return $this->all(['id', 'group_name', 'parent_id'], 'ep_sea_group');
    }

    // ====== Event ===========
    public function getEventData($limit = 0, $offset = 0, $condition = '', $order_by = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_event',
            'where' =>$condition,
            'order by' => $order_by,
            'other' =>$other
        ])->select();
    }
    public function getEventDetail($id) {
        $condition = 'id = "'.$id.'"';
        return $this->findAny(['*'], $condition, 'ep_event');
    }
    public function getEventDescription($condition) {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_even_description',
            'where' =>$condition
        ])->select();
    }
    
    // ====== Customer ===========
    public function getCustomerData($limit = 0, $offset = 0, $condition = '', $having = '', $order_by = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        $cus_column = $this->ColumnList('ep_customer');
        $cus_column['id'] = 'a.id';
        unset($cus_column['password']);
        unset($cus_column['updated']);
        $column = implode(', a.', $cus_column);
        return $this->buildQueryParam([
            'select'=> $column.' , MAX(b.order_date) as last_purchase, SUM(c.number*c.price) as total_money, SUM(c.number) as total_quantity, total_order',
            'from'  =>'ep_customer a',
            'join'  =>'LEFT JOIN ep_order b on a.id = b.customer_id 
                       LEFT JOIN ep_order_detail c on b.id = c.order_id
                       JOIN (SELECT a.id, COUNT(b.id) as total_order FROM ep_customer a LEFT JOIN ep_order b on a.id = b.customer_id GROUP BY a.id ) d on a.id=d.id',
            'where' => $condition,
            'group by'=>'a.id',
            'having'=> $having,
            'order by'=> $order_by,
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
    public function getCustomerInfo($id) {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_customer',
            'where' =>'id = "'.$id.'"'
        ])->selectOne();
    }
    public function getCus_order($id, $limit = 0, $offset = 0){
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.id, order_code, b.name as method_name, a.order_date, a.status , SUM(c.number*c.price) as total_money',
            'from'  =>'ep_order a',
            'join'  =>'JOIN ep_order_method b on a.order_method_id = b.id 
                       JOIN ep_order_detail c on a.id = c.order_id',
            'where' =>'customer_id = "'.$id.'"',
            'group by' => 'a.id',
            'order by' => 'a.order_date desc',
            'other' => $other,
        ])->select();
    }
    public function getCus_ordDetail($cusId, $orderId) {
        return $this->buildQueryParam([
            'select'=>'b.id, event_code, c.event_name, b.number, b.type, b.price , b.number*b.price as total_money',
            'from'  =>'ep_order a',
            'join'  =>'JOIN ep_order_detail b on a.id = b.order_id 
                       JOIN ep_event c on b.even_id = c.id',
            'where' =>'customer_id = "'.$cusId.'" and a.id = "'.$orderId.'"',
        ])->select();
    }
 
    // ================= Orders ======================
    public function getDataOrder($limit = 0, $offset = 0, $condition = '', $having = '', $order_by = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.*, b.cus_name, d.name as method_name, SUM(c.number*c.price) as total_money, SUM(c.number) as total_quantity',
            'from'  =>'ep_order a',
            'join'  =>'JOIN ep_customer b on a.customer_id = b.id
                       JOIN ep_order_detail c on a.id = c.order_id
                       JOIN ep_order_method d on a.order_method_id = d.id ',
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

    public function getOrderMethod() {
        return $this->buildQueryParam([
            'select'=>'*',
            'from'  =>'ep_order_method',
        ])->select();
    }
    // ================= Revenue ======================
    public function getProductReport($condition = '') {
        if($condition == '') $condition = '1';
        return $this->buildQueryParam([
            'select' => 'SUM(a.total_quantity) as total_quantityAll , SUM(a.total_money) as total_moneyAll',
            'from'   => '(SELECT b.event_code, b.event_name, d.name as method_name, SUM(a.number) as total_quantity, a.price, SUM(a.number*a.price) as total_money
                            FROM ep_order_detail a 
                            JOIN ep_event b on a.even_id = b.id 
                            JOIN ep_order c on a.order_id = c.id
                            JOIN ep_order_method d on c.order_method_id = d.id 
                            JOIN ep_customer e on c.customer_id = e.id 
                            WHERE '.$condition.' and c.status = 3 GROUP BY a.even_id) a ',
        ])->selectOne();
    }
    //  Product 

    public function getRevProductData($limit = 0, $offset = 0, $condition = '', $order_by = '') {
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select' => 'a.id, b.event_code, b.event_name,  a.type, SUM(a.number) as quantity_sold, a.price, SUM(a.number*a.price) as total_money',
            'from'   => 'ep_order_detail a',
            'join'   => 'JOIN ep_event b on a.even_id = b.id 
                         JOIN ep_order c on a.order_id = c.id',
            'where'  => $condition,
            'group by' => 'a.even_id, a.type',
            'order by' => $order_by,
            'other'  => $other,
        ])->select();
    }
    
    

}
 