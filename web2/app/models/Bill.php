<?php  
    class Bill{
        private $db;
        public function __construct(){
            $this->db = new Database;
        }

        public function getBillsByUserID($userID){
            $this->db->query('SELECT * FROM bill WHERE customerID = :customerID ORDER BY created_at DESC');
            $this->db->bind(':customerID',$userID);
            $result = $this->db->resultSet();
            return $result;
        }

        public function getBillDetailByBillID($billID){
            $this->db->query('SELECT * FROM billdetail WHERE billID = :billID');
            $this->db->bind(':billID',$billID);
            $result = $this->db->resultSet();
            return $result;
        }

        public function saveBill($bill){
            $query = "INSERT INTO bill(id, totalPrice, customerID) VALUES ";
            $query .= "(:id,:totalPrice,:customerID);";

            $this->db->query($query);

            $this->db->bind(':id',$bill['billID']);
            $this->db->bind(':totalPrice',$bill['totalPrice']);
            $this->db->bind(':customerID',$bill['customerID']);
            
            // return $query;
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function saveBillDetail($billDetailList){
            $query = "INSERT INTO billdetail(billID, productID, quantity, totalPrice) VALUES ";
            for($i = 0; $i < count($billDetailList); $i++){ 
                $query .= "(:billID_" . $i . ", ";
                $query .= ":productID_" .$i . ", ";
                $query .= ":quantity_" .$i . ", ";
                $query .= ":totalPrice_" .$i . ")";

                if($i == (count($billDetailList)-1)){
                    $query .= ";";
                }else{
                    $query .= ",";    
                }
            }

            $this->db->query($query);
            for($i = 0; $i < count($billDetailList); $i++){
                $this->db->bind(':billID_' . $i,$billDetailList[$i]['billID']);
                $this->db->bind(':productID_' . $i,$billDetailList[$i]['productID']);
                $this->db->bind(':quantity_' . $i,$billDetailList[$i]['quantity']);
                $this->db->bind(':totalPrice_' . $i,$billDetailList[$i]['totalPrice']);
            }

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getBillByID($billID){
            $this->db->query('SELECT * FROM bill WHERE id = :id');
            $this->db->bind(':id',$billID);
            $row = $this->db->singleResult();
            return $row;
        }
    }
?>