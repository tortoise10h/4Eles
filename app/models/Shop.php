<?php
    class Shop{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getLimitProducts($record_per_page,$start_from,$categoryID){
            if($categoryID == ''){
                $this->db->query("SELECT * FROM products ORDER BY created_at DESC LIMIT $start_from, $record_per_page");
            }else{
                $this->db->query("SELECT * FROM products WHERE categoryId = :categoryID ORDER BY created_at DESC  LIMIT $start_from, $record_per_page");
                $this->db->bind(':categoryID',$categoryID);
            }
            $products = $this->db->resultSet();
            return $products;
        }

        public function getTotalProduct(){
            $this->db->query("SELECT * FROM products ORDER BY created_at DESC");
            $rows = $this->db->resultSet();
            $totalProduct = $this->db->rowCount();
            return $totalProduct;
        }
    }
?> 