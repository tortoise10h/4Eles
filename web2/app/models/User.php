<?php
    class User{
        private $db;
        
        public function __construct(){
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query('INSERT INTO users(firstname,lastname,email,phone,sex,address,password) VALUES(:firstname,:lastname,:email,:phone,:sex,:address,:password)');

            $this->db->bind(':firstname',$data['firstname']);
            $this->db->bind(':lastname',$data['lastname']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':phone',$data['phone']);
            if($data['sex'] == 'male'){
                $this->db->bind(':sex',true);
            }else{
                $this->db->bind(':sex',false);
            }
            $this->db->bind(':address',$data['address']);
            $this->db->bind(':password',$data['password']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function login($email,$password){
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email',$email);
            //get user has email that match with email from user input
            $row = $this->db->singleResult();
            //get password was hashed from database
            $hashed_password = $row->password;
            //compare with password from user input
            if(password_verify($password,$hashed_password)){
                return $row;
            }else{
                return false;
            }
        }

        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email',$email);
            $row = $this->db->singleResult();
            //if rowCount > 0 => email was used
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function findUserById($id){
            $this->db->query("SELECT * FROM users WHERE id = :id");
            $this->db-bind(':id',$id);
            $row = $this->db->singleResult();
            return $row;
        }
    }
?>