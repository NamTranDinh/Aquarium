<?php

class BaseModel extends DbConnection {

    var $queryParam = array();
    var $tableName = "";
    var $tableList = array();  // có thể có nhiều cột.(Mảng 2 chiều.)
    var $columnList = array(); // có thể có nhiều cột.(Mảng 2 chiều.)

    public function __construct() {
        parent::__construct();
    }

   /**
     * trả về kq của một câu query
     * hay là hàm run query
     */
    public function query($sql, $param = []) {       
        $q = DbConnection::$connectionInstance->prepare($sql);        
        // echo "<pre>";
        // var_dump($q);
        // echo "</pre>";
        if(is_array($param) && $param){
            $q->execute($param);
        }else{
            $q->execute();
        }
        return $q;
    }

    /**
     * buildQueryParam là hàm gộp lại các thuộc tính 
     * của câu query
     */
    public function buildQueryParam($params) {
        $default = [               
            "sql"       =>"",
            "select"    =>"",       //select là chuỗi các cột của bảng mà bạn muốn select
            "from"      =>"",
            "join"      =>"",
            "where"     =>"",       //where là điều kiện của một câu query
            "group by"  =>"",
            "having"    =>"",
            "order by"  =>"",         
            "other"     =>"",       //sau where   
            "columns"   =>"",
            "field"     =>"",       //field là các cột của bảng mà ng dùng insert
            "params"    =>[],       //Dùng để merge nếu có param.
        ];
        // câu lệnh dưới là lấy queryParam khai báo ở đầu để nối với các  default,params mà người dùng nhập
        $this->queryParam = array_merge($default, $params);
        return $this;
    }

    // thành phần của câu truy vấn
    public function element($attr='', $condition) {
        
        $attr = trim($attr);
        $cond = trim($condition);
        // Thuộc tính mà là join thì phải điền đúng loại join.
        if($attr=="join" && $cond){
            return " $cond";
        } elseif($attr && $cond){
            return " $attr ".$cond;
        }
        return "";
    }

    public function select() {
        $sql =  "SELECT ".$this->queryParam["select"]
                .$this->element("from", $this->queryParam["from"])
                .$this->element("join", $this->queryParam["join"])
                .$this->element("where", $this->queryParam["where"])
                .$this->element("group by", $this->queryParam["group by"])
                .$this->element("having", $this->queryParam["having"])
                .$this->element("order by", $this->queryParam["order by"])
                .' '.$this->queryParam["other"];
        $query = $this->query($sql, $this->queryParam["params"]); 
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOne() {
        $this->queryParam['other'] = " limit 1";
        $data = $this->select();
        if ($data){
            return $data[0];
        }
        return [];
    }

    public function insert() {
        $sql =  "INSERT INTO ".$this->tableName
                .'('.$this->queryParam['columns'].')'
                .'values('.$this->queryParam['field'].')';
        $result = $this->query($sql, $this->queryParam["params"]);
        if($result){
            return DbConnection::$connectionInstance->lastInsertId();
        }else{
            return false;
        }
    }

    public function update() {
        $sql =  "UPDATE ".$this->tableName
                ." SET ".$this->queryParam["field"]
                .$this->element("where", $this->queryParam["where"])
                .' '.$this->queryParam["other"];
        return $this->query($sql, $this->queryParam['params']);
    }

    public function delete() {
        $sql =  "DELETE FROM ".$this->tableName
                .$this->element("where", $this->queryParam["where"])
                .' '.$this->queryParam["other"];
        return $this->query($sql);
    }

    public function defaultQuery($sql, $keyW = '') {
        $keyW = strtoupper($keyW);
        try{
            if($keyW=="SELECT"){
                // Trả về kết quả của câu select
                $query = $this->query($sql);
                return $query->fetchAll(PDO::FETCH_ASSOC);            
            }else{                
                // Trả về số cột bị ảnh hưởng khi insert, update, delete
                return DbConnection::$connectionInstance->exec($sql);
            }
        } catch (Exception $ex){
            // bắt lỗi khi câu query sai.
            return $ex->getMessage();
            die();
        }
    }
    
    // SELECT TABLE_NAME as TablesName 
    // from INFORMATION_SCHEMA.TABLES where table_schema = 'sonnctvk_db_minecraft' 
    // ORDER BY TABLE_NAME DESC
    public function TableList()  {
        $this->tableList = $this->buildQueryParam([
            "select"    =>"TABLE_NAME",
            "from"      =>"INFORMATION_SCHEMA.TABLES",
            "where"     =>"table_schema = :database",
            "order by"  =>"TABLE_NAME DESC",
            "params"    =>[":database"=>$this->database]
        ])->select();
        foreach($this->tableList as $value) $result[$value['TABLE_NAME']] = $value['TABLE_NAME'];
        return $result;
    }
   
    // select COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, 
    //        NUMERIC_PRECISION, DATETIME_PRECISION, IS_NULLABLE 
    // from   INFORMATION_SCHEMA.COLUMNS
    // where  TABLE_NAME='TableName'
    public function ColumnList($tableName) {
        $this->tableName = $tableName;
        $this->columnList = $this->buildQueryParam([
            "select"    =>"COLUMN_NAME",
            "from"      =>"INFORMATION_SCHEMA.COLUMNS",
            "where"     =>"TABLE_NAME = :tableName",
            "params"    =>[":tableName"=>$this->tableName]
        ])->select();        
        foreach($this->columnList as $value) $result[$value['COLUMN_NAME']] = $value['COLUMN_NAME']; 
        return $result;
    }
    /**
     * Lấy tất cả các trường
     * @param array column
     * @param int limit, offset
     * @return array
     */
    public function all($column = ['*'], $tableName, $limit = 0, $offset = 0, $condition = '') {
        $this->tableName = $tableName;
        if($limit>0) $other = "limit $limit offset $offset";
        else $other = '';
        return $this->buildQueryParam([
            'select'=> implode(', ', $column),
            'from'  => $this->tableName,
            'where' => $condition,
            'other' => $other
        ])->select();
    }

    /**
     * Tìm theo id
     * @param int id
     * @return array
     */
    public function find($id, $tableName){
        $this->tableName = $tableName;
        $data = $this->buildQueryParam([
            'select'=>'*',
            'from'  =>$this->tableName,
            'where' =>$this->columnList($this->tableName)[0]. ' = '. $id
        ])->selectOne();
        return $data;
    }

    /**
     * Thêm dữ liệu vào bảng
     * @param array data
     * @return int
     * */ 
    public function insertData($data = [], $tableName) {
        $this->tableName = $tableName;
        $column = implode(', ', array_keys($data));
        $field = rtrim(str_repeat(' ?,', count($data)), ',');
        $param = array_values($data);
        return $this->buildQueryParam([
            'columns'   =>$column,
            'field'     =>$field,
            'params'    =>$param
        ])->insert(); 
    }

    /**
     * Update dữ liệu
     * @param array data
     * @param string condition
     * @return string
     */
   
    public function updateData($data = [], $condition, $tableName) {
        $this->tableName = $tableName;
        $field = '';
        foreach ($data as $key => $value) {
            $field .= $key.' = :'.$key.', ';
            $param[":$key"] = $value;
        }
        $field = rtrim(rtrim($field), ',');
        // echo "<pre>";
        // var_dump($param);
        // var_dump($field);
        // die;
        return $this->buildQueryParam([
            'field' =>$field,
            'where' =>$condition,
            'params'=>$param,
        ])->update();
    }

    /**
     * Delete dữ liệu
     * @param string 
     * @param string 
     * @return string
     */

    public function deleteData($condition,$tableName) {
        $this->tableName = $tableName;
        return $this->buildQueryParam([
            'where'=>$condition
        ])->delete();
    }

    public function getCountRecord($tableName, $condition = '') {
        $count = $this->buildQueryParam([
            'select'=> 'count(*)',
            'from'  => $tableName,
            'where' => $condition
        ])->select();
        return $count[0]['count(*)'];
    }

    
}