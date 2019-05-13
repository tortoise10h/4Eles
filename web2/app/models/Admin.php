<?php
    class Admin{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getAllProducts($sort,$price){
            $price = explode('--',$price);

            $query = 'SELECT * FROM products WHERE 1';

            //price handle
            if($price[0] != '@none@' && $price[1] != '@none@'){
                $query .= " AND price >= :fromprice AND price <= :toprice";
            }elseif($price[0] == '@none@' && $price[1] != '@none@'){
                $query .= " AND price <= :toprice";
            }elseif($price[0] != '@none@' && $price[1] == '@none@'){
                $query .= " AND price >= :fromprice";
            }

            //sort handle
            if($sort == 'none'){
                $query .= " ORDER BY created_at DESC";
            }elseif($sort == 'priceLowToHigh'){
                $query .= " ORDER BY price ASC LIMIT";
            }elseif($sort == 'priceHighToLow'){
                $query .= " ORDER BY price DESC LIMIT";
            }elseif($sort == 'nameAtoZ'){
                $query .= " ORDER BY name ASC LIMIT";
            }elseif($sort == 'nameZtoA'){
                $query .= " ORDER BY name DESC LIMIT";
            }

            $this->db->query($query);

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

            $products = $this->db->resultSet();
            return $products;
        }

        public function getCategoryList(){
            $this->db->query('SELECT * FROM category');
            $row = $this->db->resultSet();
            return $row;
        }

        public function editProduct($product){
            $query = 'UPDATE products SET name = :name, categoryID = :categoryID, price = :price,
             total = :total, description = :description, color = :color WHERE id = :id';

            $this->db->query($query);

            $this->db->bind(':name',$product['name']);
            $this->db->bind(':categoryID',$product['categoryID']);
            $this->db->bind(':price',$product['price']);
            $this->db->bind(':total',$product['total']);
            $this->db->bind(':description',$product['description']);
            $this->db->bind(':color',$product['color']);
            $this->db->bind(':id',$product['id']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function deleteProduct($productID){
            $this->db->query("UPDATE products SET status = :status WHERE id = :id");

            $this->db->bind(':id',$productID);
            $this->db->bind(':status',false);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function reDeleteProduct($productID){
            $this->db->query("UPDATE products SET status = :status WHERE id = :id");

            $this->db->bind(':id',$productID);
            $this->db->bind(':status',true);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function addNewProduct($product){
            $query = 'INSERT INTO products(id,name,categoryID,price,total,description,imgLink,color) VALUES';
            $query .= '(:id, :name, :categoryID, :price, :total, :description, :imgLink, :color);';

            $this->db->query($query);

            $this->db->bind(':id',$product['id']);
            $this->db->bind(':name',$product['name']);
            $this->db->bind(':categoryID',$product['categoryID']);
            $this->db->bind(':price',$product['price']);
            $this->db->bind(':total',$product['total']);
            $this->db->bind(':description',$product['description']);
            $this->db->bind(':imgLink',$product['imgLink']);
            $this->db->bind(':color',$product['color']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function isProductIDExist($productID){
            $this->db->query("SELECT * FROM products WHERE id = :id");
            $this->db->bind(':id',$productID);
            $row = $this->db->singleResult();
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
    }
?>