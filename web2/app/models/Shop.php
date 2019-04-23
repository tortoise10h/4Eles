<?php
    class Shop{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function countCategoryQuantity(){
            $figCount = 0;
            $pluCount = 0;
            $hatCount = 0;
            $shiCount = 0;
            $this->db->query("SELECT * FROM products");
            $rows = $this->db->resultSet();
            foreach($rows as $product){
                switch($product->categoryID){
                    case 'fig':{
                        $figCount++;
                        break;
                    }
                    case 'plu':{
                        $pluCount++;
                        break;
                    }
                    case 'shi':{
                        $shiCount++;
                        break;
                    }
                    case 'hat':{
                        $hatCount++;
                        break;
                    }
                }
            }
            $data = [
                'figCount' => $figCount,
                'pluCount' => $pluCount,
                'shiCount' => $shiCount,
                'hatCount' => $hatCount,
            ];
            return $data;
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

        public function getAllProducts(){
            $this->db->query("SELECT * FROM products ORDER BY created_at DESC");
            $products = $this->db->resultSet();
            return $products;
        }

        public function getLimitSearchProducts($record_per_page,$start_from,$categoryID,$searchValue){
            // return $searchValue;
            $query = '';
            if($categoryID == 'all'){
                $query .= "SELECT * FROM products ";
            }else{
                $query .= "SELECT * FROM products WHERE categoryID = :categoryID ";
            }
            
            if($searchValue != '' && $categoryID != 'all'){
                $query .= " AND name LIKE '%$searchValue%'"; 
            }elseif($searchValue != '' && $categoryID == 'all'){
                $query .= "WHERE name LIKE '%$searchValue%'";
            }

            $query .= " ORDER BY created_at DESC LIMIT $start_from,$record_per_page";

            // return $query;
            $this->db->query($query);

            if($categoryID != 'all'){
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

        public function countSearchProduct($categoryID,$searchValue){
            $query = '';
            if($categoryID == 'all'){
                $query .= "SELECT * FROM products ";
            }else{
                $query .= "SELECT * FROM products WHERE categoryID = :categoryID ";
            }

            if($searchValue != '' && $categoryID != 'all'){
                $query .= " AND name LIKE '%$searchValue%'"; 
            }elseif($searchValue != '' && $categoryID == 'all'){
                $query .= "WHERE name LIKE '%$searchValue%'";
            }

            $query .= " ORDER BY created_at DESC";
            $this->db->query($query);
            if($categoryID != 'all'){
                $this->db->bind(':categoryID',$categoryID);
            }

            $products = $this->db->resultSet();
            $numOfProduct = $this->db->rowCount();
            return $numOfProduct;
        }
        

        public function getProductDetail($productID){
            $this->db->query("SELECT * FROM products WHERE id = :id");
            $this->db->bind(':id',$productID);
            $row = $this->db->singleResult();
            return $row;    
        }
        
    }
?> 