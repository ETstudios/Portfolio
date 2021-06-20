<?php
class Database {      
    private $conn;
    
    public function __construct ($level) {
        $dir = "";
        $this->conn = false;
        
        if(isset($level) && is_numeric($level)) {
            for($i = 0; $i < $level; $i++) {
                $dir .= "../";
            }
        }
        
        $access = $dir . "access.php";
        include $access;
        $this->purchaseInfo = $purchaseInfo;
        $conn = new mysqli($db_data['server'], $db_data['user'], $db_data['password']);
        if(!$conn->connect_error) {
            $this->conn = $conn;
        }
    }
    
    public function Connect() {
        return $this->conn;
    }
}
?>