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
                $this->db->query("SELECT * FROM products WHERE status = :status ORDER BY created_at DESC LIMIT $start_from, $record_per_page");
                $this->db->bind(':status',true);
            }else{
                //load by category
                $this->db->query("SELECT * FROM products WHERE categoryID = :categoryID AND status = :status ORDER BY created_at DESC  LIMIT $start_from, $record_per_page");
                $this->db->bind(':categoryID',$categoryID);
                $this->db->bind(':status',true);
            }
            $products = $this->db->resultSet();
            return $products;
        }

        public function getAllProducts(){
            $this->db->query("SELECT * FROM products WHERE status = :status ORDER BY created_at DESC");
            $this->db->bind(':status',true);
            $products = $this->db->resultSet();
            return $products;
        }

        public function getLimitSearchProducts($record_per_page,$start_from,$categoryID,$searchValue,$price,$color,$sort){
            //CREATE QUERY
            //split price variable to get from price and to price
            $price = explode('--',$price);

            $query = 'SELECT * FROM products WHERE status = :status';

            
            //category handle
            if($categoryID != 'all'){
                $query .= " AND categoryID = :categoryID ";
            }
            
            //price handle
            if($price[0] != '@none@' && $price[1] != '@none@'){
                $query .= " AND price >= :fromprice AND price <= :toprice";
            }elseif($price[0] == '@none@' && $price[1] != '@none@'){
                $query .= " AND price <= :toprice";
            }elseif($price[0] != '@none@' && $price[1] == '@none@'){
                $query .= " AND price >= :fromprice";
            }
            
            //color handle
            if($color != 'none'){
                $query .= " AND color = :color";
            }
            
            //search value handle
            if($searchValue != ''){
                $query .= " AND name LIKE '%$searchValue%'"; 
            }
            
            //sort handle
            if($sort == 'none'){
                $query .= " ORDER BY created_at DESC LIMIT $start_from,$record_per_page";
            }elseif($sort == 'priceLowToHigh'){
                $query .= " ORDER BY price ASC LIMIT $start_from,$record_per_page";
            }elseif($sort == 'priceHighToLow'){
                $query .= " ORDER BY price DESC LIMIT $start_from,$record_per_page";
            }elseif($sort == 'nameAtoZ'){
                $query .= " ORDER BY name ASC LIMIT $start_from,$record_per_page";
            }elseif($sort == 'nameZtoA'){
                $query .= " ORDER BY name DESC LIMIT $start_from,$record_per_page";
            }

            
            //BIND VALUE TO QUERY

            // prepare query with prepare statement
            $this->db->query($query);

            $this->db->bind(':status',true);

            if($categoryID != 'all'){
                $this->db->bind(':categoryID',$categoryID);
            }

            if($price[0] != '@none@' && $price[1] != '@none@'){
                $fromPrice = (int) $price[0];
                $toPrice = (int) $price[1];
                $this->db->bind(':fromprice',$fromPrice);
                $this->db->bind(':toprice',$toPrice);
            }elseif($price[0] == '@none@' && $price[1] != '@none@'){
                $toPrice = (int) $price[1];
                $this->db->bind(':toprice',$toPrice);
            }elseif($price[0] != '@none@' && $price[1] == '@none@'){
                $fromPrice = (int) $price[0];
                $this->db->bind(':fromprice',$fromPrice);
            }

            if($color != 'none'){
                $this->db->bind(':color',$color);
            }
            
            $products = $this->db->resultSet();
            return $products;
        }

        public function countProduct($categoryID){
            if($categoryID == 'all'){
                $this->db->query("SELECT * FROM products WHERE status = :status ORDER BY created_at DESC");   
                $this->db->bind(':status',true);
            }else{
                $this->db->query("SELECT * FROM products WHERE categoryID = :categoryID AND status = :status ORDER BY created_at DESC");
                $this->db->bind(':categoryID',$categoryID);
                $this->db->bind(':status',true);
            }
            $rows = $this->db->resultSet();
            $numOfProduct = $this->db->rowCount();
            return $numOfProduct;
        }

        public function countSearchProduct($categoryID,$searchValue,$price,$color){
            // return $searchValue;
            $price = explode('--',$price);

            $query = 'SELECT * FROM products WHERE status = :status';
            if($categoryID != 'all'){
                $query .= " AND categoryID = :categoryID ";
            }
            

            if($price[0] != '@none@' && $price[1] != '@none@'){
                $query .= " AND price >= :fromprice AND price <= :toprice";
            }elseif($price[0] == '@none@' && $price[1] != '@none@'){
                $query .= " AND price <= :toprice";
            }elseif($price[0] != '@none@' && $price[1] == '@none@'){
                $query .= " AND price >= :fromprice";
            }

            if($color != 'none'){
                $query .= " AND color = :color";
            }

            if($searchValue != ''){
                $query .= " AND name LIKE '%$searchValue%'"; 
            }

            $query .= " ORDER BY created_at DESC";

            // return $query;
            $this->db->query($query);

            $this->db->bind(':status',true);

            if($categoryID != 'all'){
                $this->db->bind(':categoryID',$categoryID);
            }

            if($price[0] != '@none@' && $price[1] != '@none@'){
                $fromPrice = (int) $price[0];
                $toPrice = (int) $price[1];
                $this->db->bind(':fromprice',$fromPrice);
                $this->db->bind(':toprice',$toPrice);
            }elseif($price[0] == '@none@' && $price[1] != '@none@'){
                $toPrice = (int) $price[1];
                $this->db->bind(':toprice',$toPrice);
            }elseif($price[0] != '@none@' && $price[1] == '@none@'){
                $fromPrice = (int) $price[0];
                $this->db->bind(':fromprice',$fromPrice);
            }

            if($color != 'none'){
                $this->db->bind(':color',$color);
            }

            $products = $this->db->resultSet();
            $numOfProduct = $this->db->rowCount();
            return $numOfProduct;
        }
        

        public function getProductDetail($productID){
            $this->db->query("SELECT * FROM products WHERE id = :id AND status = :status");
            $this->db->bind(':id',$productID);
            $this->db->bind(':status',true);
            $row = $this->db->singleResult();
            return $row;    
        }

        public function adminGetProductDetail($productID){
            $this->db->query("SELECT * FROM products WHERE id = :id");
            $this->db->bind(':id',$productID);
            $row = $this->db->singleResult();
            return $row;    
        }
        
    }
?> 