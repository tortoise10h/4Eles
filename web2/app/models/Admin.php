<?php
    class Admin{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getAllProducts($sort){

            $query = 'SELECT * FROM products ';

            //sort handle
            if($sort == 'none'){
                $query .= " ORDER BY created_at DESC";
            }elseif($sort == 'priceLowToHigh'){
                $query .= " ORDER BY price ASC";
            }elseif($sort == 'priceHighToLow'){
                $query .= " ORDER BY price DESC";
            }elseif($sort == 'nameAtoZ'){
                $query .= " ORDER BY name ASC";
            }elseif($sort == 'nameZtoA'){
                $query .= " ORDER BY name DESC";
            }

            $this->db->query($query);

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

        /*** FOR ORDERS ***/
        public function getAllOrders($sort){

            $query = 'SELECT * FROM bill ';

            //sort handle
            if($sort == 'dateNewToOld'){
                $query .= " ORDER BY created_at DESC";
            }elseif($sort == 'dateOldToNew'){
                $query .= " ORDER BY created_at ASC";
            }elseif($sort == 'priceLowToHigh'){
                $query .= " ORDER BY totalPrice ASC";
            }elseif($sort == 'priceHighToLow'){
                $query .= " ORDER BY totalPrice DESC";
            }

            $this->db->query($query);

            $orders = $this->db->resultSet();
            return $orders;
        }


        public function changeProcessStatusOfOrder($processStatus,$orderID){
            $this->db->query('UPDATE bill SET processStatus = :processStatus WHERE id = :id');
            $this->db->bind(':processStatus',$processStatus);
            $this->db->bind(':id',$orderID);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        /*** FOR USERS ***/
        public function getAllUsers($sort){

            $query = 'SELECT * FROM users ';

            //sort handle
            // if($sort == 'nameAToZ'){
            //     $query .= " ORDER BY created_at DESC";
            // }elseif($sort == 'dateOldToNew'){
            //     $query .= " ORDER BY created_at ASC";
            // }elseif($sort == 'priceLowToHigh'){
            //     $query .= " ORDER BY totalPrice ASC";
            // }elseif($sort == 'priceHighToLow'){
            //     $query .= " ORDER BY totalPrice DESC";
            // }

            $this->db->query($query);

            $users = $this->db->resultSet();
            return $users;
        }

        public function changeUserRole($userID,$roleID){
            $this->db->query("UPDATE users SET roleID = :roleID WHERE id = :id");
            $this->db->bind(':roleID',$roleID);
            $this->db->bind(':id',$userID);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function resetPassword($userID,$password){
            $this->db->query("UPDATE users SET password = :password WHERE id = :id");
            $this->db->bind(':password',$password);
            $this->db->bind(':id',$userID);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function blockUser($userID){
            $this->db->query("UPDATE users SET status = :status WHERE id = :id");
            $this->db->bind(':status',false);
            $this->db->bind(':id',$userID);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function unblockUser($userID){
            $this->db->query("UPDATE users SET status = :status WHERE id = :id");
            $this->db->bind(':status',true);
            $this->db->bind(':id',$userID);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function createNewAccount($email,$role,$password){
            $this->db->query("INSERT INTO users(email,password,roleID) VALUES(:email,:password,:roleID);");
            $this->db->bind(':email',$email);
            $this->db->bind(':password',$password);
            $this->db->bind(':roleID',$role);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
?>