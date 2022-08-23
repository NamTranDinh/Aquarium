<?php
/**
 * Thông số host, db,... ở => /config.php
 */
class DbConnection{
    private $host = HOST;
    private $username = USERNAME;
    private $password = PASSWORD;
    protected $database = DATABASE;
    
    protected static $connectionInstance = null;
    /**
     * Kết nối với db đầu tiên
     */
    public function __construct() {
        $this->connect();
    }
    /**
     * Tạo kết nối đến database
     * 
     * return new PDO
     */
    
    public function connect(){
        if(self::$connectionInstance === null){
            try{
                self::$connectionInstance = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password);
                self::$connectionInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $ex){
                echo "ERROR:".$ex->getMessage();
                die();
            }
        }
        return self::$connectionInstance;
    }
}
?>
