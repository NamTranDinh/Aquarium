<?php 

class AjaxModel extends BaseModel{
    public function getRecord($tableName, $condition = '') {
        return $this->getCountRecord($tableName, $condition);
    }
    public function destroy($condition, $tableName) {
        return $this->deleteData($condition, $tableName);
    }
    public function updateField($data = [], $condition, $tableName) {
        return $this->updateData($data, $condition, $tableName);
    }
    public function store($data = [], $tableName) {
        return $this->insertData($data, $tableName);
    }
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
    // ============ home ============
    public function getListEventName() {
        return $this->buildQueryParam([
            'select'=>'id, event_name, event_sub_img',
            'from'  =>'ep_event',
            'where' =>'status = 1',
            'order by' =>'id desc',
            'other' =>'limit 15 offset 0',
        ])->select();
    }
    public function getListAnimalName($condition = '') {
        return $this->buildQueryParam([
            'select'=>'sea_id, sea_name, sea_sub_img',
            'from'  =>'ep_sea_animal',
            'where' =>'status = 1'.$condition,
            'order by' =>'created desc',
            'other' =>'limit 8 offset 0',
        ])->select();
    }
    public function getListCateName() {
        return $this->buildQueryParam([
            'select'=>'id, group_name',
            'from'  =>'ep_sea_group',
            'where' =>'status = 1 and parent_id = -1',
            'order by' =>'id asc',
            'other' =>'limit 8 offset 0',
        ])->select();
    }
   
    // ============== Animal Guide ============
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

    // ============== Event Guide =============
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
    public function getEventDetail($id, $column = ['*']) {
        $condition = 'id in ('.$id.') and status = 1';
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => 'ep_event',
            'where' => $condition,
            'order by' => 'id'
        ])->select();
    }
    // =============== single event =================
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
    // =============== cart - order =================
    public function get_cusOrder($limit = 0, $offset = 0, $condition = ''){
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=>'a.id, order_code, b.name as method_name, a.order_date, a.status , SUM(c.number*c.price) as total_money',
            'from'  =>'ep_order a',
            'join'  =>'JOIN ep_order_method b on a.order_method_id = b.id 
                       JOIN ep_order_detail c on a.id = c.order_id',
            'where' =>$condition,
            'group by' => 'a.id',
            'order by' => 'a.order_date desc',
            'other' => $other,
        ])->select();
    }
    public function get_ordDetail($cusId, $orderId) {
        return $this->buildQueryParam([
            'select'=>'b.id, event_code, c.event_name, b.type, b.number, b.price , b.number*b.price as total_money',
            'from'  =>'ep_order a',
            'join'  =>'JOIN ep_order_detail b on a.id = b.order_id 
                       JOIN ep_event c on b.even_id = c.id',
            'where' =>'customer_id = "'.$cusId.'" and a.id = "'.$orderId.'"',
        ])->select();
    }
    // =========== Account ==============
  
    public function getDataUser($condition) {
        return $this->buildQueryParam([
        'select'=>'id, username, cus_name, gender, datebirth, phone, email, address, avatar, token',
        'from'=>'ep_customer',
        'where'=>$condition,
        ])->select();
    }
   
}
    
    