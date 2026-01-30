<?php
    class Product {
        private $conn;

        public function __construct($db){
          $this->conn = $db;
        }

        public function getAll(){
          $stmt = $this->conn->query("SELECT * FROM products ORDER BY id DESC");
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function add($title, $description, $image, $created_by){
          $stmt = $this->conn->prepare("INSERT INTO products (title, description, image, created_by) VALUES (?,?,?,?)");
          $stmt->execute([$title, $description, $image, $created_by]);
        }

           public function update($id, $title, $description) {
          $stmt = $this->conn->prepare("UPDATE products SET title=?, description=? WHERE id=?");
          $stmt->execute([$title, $description, $id]);
       }

          public function delete($id) {
              $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
              $stmt->execute([$id]);
          }




    }





?>