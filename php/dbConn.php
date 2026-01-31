<?php
class dbConn {
    private $host = "localhost";
    private $dbname = "restaurant_db";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connectDB() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Lidhja deshtoi: " . $e->getMessage());
        }
    }
}
?>