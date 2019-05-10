<?php
    class Profile{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getUserInfoById($id){
            $this->db->query("SELECT * FROM users WHERE id = :id");
            $this->db->bind(':id',$id);
            $row = $this->db->singleResult();
            
            return $row;
        }
    }
?>