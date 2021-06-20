<?php
class Input {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function Input($in) {
        $out = mysqli_real_escape_string($this->conn, $in);
        $out = strip_tags($out);
        $out = stripslashes($out);
        $out = htmlspecialchars($out);
        return $out;
    }
}
?>