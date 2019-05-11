<?php
    class Cart{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getProduct($productID){
            $this->db->query("SELECT * FROM products WHERE id = :id");
            $this->db->bind(':id',$productID);
            $row = $this->db->singleResult();
            return $row;
        }

        
    }
?>