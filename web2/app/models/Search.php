<?php
    class Search{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }
        
        public function getSearchResult($record_per_page,$start_from,$searchValue){
            $query = '';
            if($searchValue == ''){
                $query = "SELECT * FROM products LIMIT $start_from,$record_per_page";
                $this->db->query($query);
            }else{
                $query = "SELECT * FROM products WHERE name LIKE '%$searchValue%' LIMIT $start_from,$record_per_page";
                $this->db->query($query);
                // $this->db->bind(':name',$searchValue);
            }

            $products = $this->db->resultSet();
            return $products;
        }

        public function countTotalSearchProducts($searchValue){
            $query = '';
            if($searchValue == ''){
                $query = "SELECT * FROM products";
                $this->db->query($query);
            }else{
                $query = "SELECT * FROM products WHERE name LIKE '%$searchValue%'";
                $this->db->query($query);
                // $this->db->bind(':name',$searchValue);
            }
            $products = $this->db->resultSet();
            $totalProduct = $this->db->rowCount();
            return $totalProduct;
        }
    }
?>