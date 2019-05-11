<?php
    class Profiles extends Controller{
        public function __construct(){
            $this->profileModel = $this->model('Profile');
            $this->userModel = $this->model('User');
            $this->billModel = $this->model('Bill');
            $this->shopModel = $this->model('Shop');
        }

        public function index(){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            $bills = $this->getBillListOfUser($currentUser['id']);
            $result = [
                'currentUser' => $currentUser,
                'bills' => $bills
            ];
            $this->view('profiles/index',$result);
        }

        public function getBillListOfUser($userID){
            $billList = $this->billModel->getBillsByUserID($userID);
            $bills = [];

            foreach($billList as $bill){
                $billDetailList = $this->billModel->getBillDetailByBillID($bill->id);
                $billDetails = [];
                //get bill detail follow by bill id
                foreach($billDetailList as $billDetail){
                    $product = $this->shopModel->getProductDetail($billDetail->productID);
                    $temp = [
                        'productName' => $product->name,
                        'quantity' => $billDetail->quantity,
                        'totalPrice' => $billDetail->totalPrice
                    ];
                    $billDetails[] = $temp;
                }
                $billTemp = [
                    'billID' => $bill->id,
                    'purchaseDate' => $bill->created_at,
                    'totalPrice' => $bill->totalPrice,
                    'processStatus' => $bill->processStatus,
                    'billDetails' => $billDetails
                ];

                $bills[] = $billTemp;
            }
            return $bills;
        }

        public function updateUserInfo(){
            $email = $_POST['user_email'];
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $phone = $_POST['user_phonenum'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $birthday = $_POST['birthday'];

            $this->userModel->updateUserInfo($email,$firstname,$lastname,$gender,$phone,$address,$birthday);

            $result = $this->getCurrentUserAndParseToAssocArr();
            $this->view('profiles/index',$result);
            
        }

        public function changeUserImage(){
            //get user to get email of user and create image file path
            $userId = $this->getUserSession();
            $user = $this->profileModel->getUserInfoById($userId);

            //get file submit form user
            $file_name = $_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_store = "../public/images/users/" . $user->email . '-' . $filename;
            $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

            //move image of user choose to folder of user image
            if(move_uploaded_file($temp_name, $file_store)){
            }else{
                echo "Something went wrong";
            }

        }

        public function getCurrentUserAndParseToAssocArr(){
            $userId = $this->getUserSession();
            $user = $this->profileModel->getUserInfoById($userId);
            $result = [
                'id' => $userId,
                'email' => $user->email,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'phone' => $user->phone,
                'address' => $user->address,
                'sex' => $user->sex,
                'password' => $user->password,
                'birthday' => $user->birthday
            ];

            return $result;
        }

        public function getUserSession(){
            if(!empty($_SESSION['user_id'])){
                return $_SESSION['user_id'];
            }else{
                return "none-user";
            }
        }

        public function checkUserPasswordInput(){
            $currentPassword = $_POST['currentPassword'];
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            //compare with password from user input
            if(password_verify($currentPassword,$currentUser['password'])){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function updateUserPassword(){
            $newPassword = $_POST['newpassword'];
            $newPassword = password_hash($newPassword,PASSWORD_DEFAULT);
            $user = $this->getCurrentUserAndParseToAssocArr();
            
            if($this->userModel->updateUserPassword($newPassword,$user['id'])){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
?>