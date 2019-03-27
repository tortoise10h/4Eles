<?php
    class Shop{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getLimitProducts($record_per_page,$start_from,$categoryID){
            if($categoryID == 'all'){
                //load all product
                $this->db->query("SELECT * FROM products ORDER BY created_at DESC LIMIT $start_from, $record_per_page");
            }else{
                //load by category
                $this->db->query("SELECT * FROM products WHERE categoryID = :categoryID ORDER BY created_at DESC  LIMIT $start_from, $record_per_page");
                $this->db->bind(':categoryID',$categoryID);
            }
            $products = $this->db->resultSet();
            return $products;
        }

        public function countProduct($categoryID){
            if($categoryID == 'all'){
                $this->db->query("SELECT * FROM products ORDER BY created_at DESC");   
            }else{
                $this->db->query("SELECT * FROM products WHERE categoryID = :categoryID ORDER BY created_at DESC");
                $this->db->bind(':categoryID',$categoryID);
            }
            $rows = $this->db->resultSet();
            $numOfProduct = $this->db->rowCount();
            return $numOfProduct;
        }
    }
?> 