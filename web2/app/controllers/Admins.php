<?php
    class Admins extends Controller{
        public function __construct(){
            $this->adminModel = $this->model('Admin');
            $this->shopModel = $this->model('Shop');
            $this->userModel = $this->model('User');
            $this->billModel = $this->model('Bill');
            $this->profileModel = $this->model('Profile');
        }

        public function index(){
            $this->view('admins/products');
        }
        
        public function products(){
            $this->view('admins/products');
        }

        public function users(){
            $this->view('admins/users');
        }

        public function orders(){
            $this->view('admins/orders');
        }

        public function statistics(){
            $this->view('admins/statistics');
        }

        public function getProducts($sort = 'none'){
            
            $products = $this->adminModel->getAllProducts($sort);
            
            $productArr = [];
            
            foreach($products as $product){
                $productArr[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'categoryID' => $product->categoryID,
                    'price' => $product->price,
                    'total' => $product->total,
                    'description' => $product->description,
                    'imgLink' => $product->imgLink,
                    'status' => $product->status,
                    'color' => $product->color,
                ];
            }
            
            $result = [
                'products' => $productArr,
            ];
            
            echo json_encode($result);
        }

        public function checkBillQuantity($orderID){
            $billDetails = $this->billModel->getBillDetailByBillID($orderID);
            $textResult = [];
            $is_bill_ok = true;
            $result = [
                'status' => $is_bill_ok,
                'textResult' => $textResult
            ];
            foreach($billDetails as $billDetail){
                $product = $this->shopModel->adminGetProductDetail($billDetail->productID);
                if($billDetail->quantity > $product->total){
                    $temp = [
                        'productID' => $product->id,
                        'productName' => $product->name
                    ];
                    $textResult[] = $temp;
                    $is_bill_ok = false;
                }
            }  

            $status = 'true';
            if($is_bill_ok == false){
                $status = 'false';
            }
            $result = [
                'status' => $status,
                'textResult' => $textResult
            ];

            echo json_encode($result);
        }

        public function getProductByID($productID){
            $product = $this->shopModel->adminGetProductDetail($productID);
            $categoryList = $this->adminModel->getCategoryList();

            $categoryResult = [];

            foreach($categoryList as $category){
                $categoryTemp = [
                    'id' => $category->categoryID,
                    'name' => $category->categoryName
                ];

                $categoryResult[] = $categoryTemp;
            }

            $result = [
                'id' => $product->id,
                'name' => $product->name,
                'categoryID' => $product->categoryID,
                'categoryList' => $categoryResult,
                'price' => $product->price,
                'total' => $product->total,
                'color' => $product->color,
                'description' => $product->description
            ];

            echo json_encode($result);
        }

        public function getCategoryList(){
            $categoryList = $this->adminModel->getCategoryList();

            $categoryResult = [];

            foreach($categoryList as $category){
                $categoryTemp = [
                    'id' => $category->categoryID,
                    'name' => $category->categoryName
                ];

                $categoryResult[] = $categoryTemp;
            }
           echo json_encode($categoryResult);
        }

        public function checkProductFile(){
            $root = str_replace('app','public',APPROOT);

            $file_name = $_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
            $file_store =  $root . '\images\banner\huy.' . $file_extension;

            if($file_extension == 'jpg'){
                echo 1;
            }else{
                echo 0;
            }
            
        }

        public function saveEditImage(){
            $root = str_replace('app','public',APPROOT);

            $productID = $_POST['productID'];
            $productCategory = $_POST['productCategory'];

            $file_name = $_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
            $realFileName = $productID . '_1.' . $file_extension;
            $file_store =  $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_1.' . $file_extension;

            if(move_uploaded_file($temp_name, $file_store)){

            }
        }


        public function editProductWithoutImage($productID,$productName,$productCategory='',$productPrice,$productTotal,$productColor,$productDescription){
            $productDescription = str_replace('--','%',$productDescription);
            $productDescription = str_replace('@@',' ',$productDescription);
            $productName = str_replace('@@',' ',$productName);

            $product = [
                'id' => $productID,
                'name' => $productName,
                'categoryID' => $productCategory,
                'price' => $productPrice,
                'total' => $productTotal,
                'color' => $productColor,
                'description' => $productDescription
            ];
            

            if($this->adminModel->editProduct($product)){
                echo 1;
            }else{
                echo 0;
            }
        }


        public function deleteProduct($productID){
            if($this->adminModel->deleteProduct($productID)){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function reDeleteProduct($productID){
            if($this->adminModel->reDeleteProduct($productID)){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function saveDefaultImageForNewProduct($productID,$productCategory){
            $root = str_replace('app','public',APPROOT);
            $filePath = $root . "\images\products\default-product-img.jpg";
            header('Content-type: ' . "image/jpeg");
            $image = file_get_contents($filePath);

            $file_extension = explode('.', $filePath)[1];
            
            $firstImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_1.' . $file_extension;
            $secondImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_2.' . $file_extension;
            $thirdImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_3.' . $file_extension;
            $fouthImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_4.' . $file_extension;

            mkdir($root . '\images\products\\' . $productCategory . '\\' . $productID,0777,true);

            file_put_contents($firstImagePath, $image);
            file_put_contents($secondImagePath, $image);
            file_put_contents($thirdImagePath, $image);
            file_put_contents($fouthImagePath, $image);
        }

        public function saveImageForNewProduct(){
            $root = str_replace('app','public',APPROOT);

            $productID = $_POST['newProductID'];
            $productCategory = $_POST['newProductCategory'];

            $file_name = $_FILES['file']['name'];
            $temp_name = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_size = $_FILES['file']['size'];
            $file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

            $firstImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_1.' . $file_extension;
            $secondImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_2.' . $file_extension;
            $thirdImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_3.' . $file_extension;
            $fouthImagePath = $root . '\images\products\\' . $productCategory . '\\' . $productID . '\\' . $productID . '_4.' . $file_extension;

            mkdir($root . '\images\products\\' . $productCategory . '\\' . $productID,0777,true);
            
            move_uploaded_file($temp_name, $firstImagePath);
            
            copy($firstImagePath, $secondImagePath);
            copy($firstImagePath, $thirdImagePath);
            copy($firstImagePath, $fouthImagePath);
            
            
        }

        public function addNewProductInfo($productID,$productName,$productCategory='',$productPrice,$productTotal,$productColor,$productDescription){
            $productDescription = str_replace('--','%',$productDescription);
            $productDescription = str_replace('@@',' ',$productDescription);
            $productName = str_replace('@@',' ',$productName);

            $imgLink = '/images/products/' . $productCategory . '/' . $productID;
            
            $product = [
                'id' => $productID,
                'name' => $productName,
                'categoryID' => $productCategory,
                'price' => $productPrice,
                'total' => $productTotal,
                'color' => $productColor,
                'description' => $productDescription,
                'imgLink' => $imgLink  
            ];
            

            if($this->adminModel->addNewProduct($product)){
                echo 1;
            }else{
                echo 0;
            }
        }


        public function isProductIDExist($productID){
            if($this->adminModel->isProductIDExist($productID)){
                echo 1;
            }else{
                echo 0;
            }
        }

        /*** FOR ORDER ***/


        public function getOrders($sort = 'none'){
            
            $orders = $this->adminModel->getAllOrders($sort);
            
            $orderArr = [];
            
            foreach($orders as $order){
                $user = $this->userModel->getUserInfoById($order->customerID);
                $userEmail = $user->email;
                $orderArr[] = [
                    'id' => $order->id,
                    'totalPrice' => $order->totalPrice,
                    'date' => $order->created_at,
                    'processStatus' => $order->processStatus,
                    'userEmail' => $userEmail
                ];
            }
            
            $result = [
                'orders' => $orderArr,
            ];
            
            echo json_encode($result);
        }



        public function getOrderInfo($orderID){
            $bill = $this->billModel->getBillByID($orderID);
            $billDetails = $this->billModel->getBillDetailByBillID($orderID);
            $userID = $bill->customerID;
            $user = $this->userModel->getUserInfoById($userID);

            $userInfo = [
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'phone' => $user->phone,
                'sex' => $user->sex,
                'address' => $user->address
            ];

            $billDetailList = [];
            foreach($billDetails as $billDetail){
                $product = $this->shopModel->getProductDetail($billDetail->productID);
                $temp = [
                    'productName' => $product->name,
                    'quantity' => $billDetail->quantity,
                    'totalPrice' => $billDetail->totalPrice
                ];

                $billDetailList[] = $temp;
            }

            $orderInfo = [
                'billDetails' => $billDetailList,
                'userInfo' => $userInfo
            ];

            echo json_encode($orderInfo);
        }

        public function changeProcessStatusOfOrder($processStatus,$orderID){
            if($this->adminModel->changeProcessStatusOfOrder($processStatus,$orderID)){
                echo 1;
            }else{
                echo 0;
            }
        }


        /***FOR USERS***/
        public function getUsers($sort = 'none'){
            
            $users = $this->adminModel->getAllUsers($sort);
            
            $userArr = [];
            
            foreach($users as $user){
                $userArr[] = [
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'sex' => $user->sex,
                    'status' => $user->status
                ];
            }
            
            $result = [
                'users' => $userArr,
            ];
            
            echo json_encode($result);
        }


        public function getUserInfo($userID){
            $user = $this->userModel->getUserInfoById($userID);
            $row = [
                'id' => $user->id,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'phone' => $user->phone,
                'sex' => $user->sex,
                'status' => $user->status,
                'roleID' => $user->roleID,
            ];

            echo json_encode($row);
        }

        public function changeUserRole($userID,$roleID){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            if($currentUser['id'] == $userID){
                echo 3;
            }else{
                if($this->adminModel->changeUserRole($userID,$roleID)){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

        public function resetPassword($userID){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            $defaultPassword = '123456';
            $defaultPassword = password_hash($defaultPassword,PASSWORD_DEFAULT);

            if($currentUser['id'] == $userID){
                echo 3;
            }else{
                if($this->adminModel->resetPassword($userID,$defaultPassword)){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }

        public function blockUser($userID){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            if($currentUser['id'] == $userID){
                echo 3;
            }else{
                if($this->adminModel->blockUser($userID)){
                    echo 1;
                }else{
                    echo 0;
                }
            }
        }
        
        public function unblockUser($userID){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            if($currentUser['id'] == $userID){
                echo 3;
            }else{
                if($this->adminModel->unblockUser($userID)){
                    echo 1;
                }else{
                    echo 0;
                }
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
                'birthday' => $user->birthday,
                'statuts' => $user->status
            ];

            return $result;
        }

        public function checkEmail($email){
            if($this->userModel->findUserByEmail($email) == false){
                echo 1;
            }else{
                echo 0;
            }
        }

        function createNewAccount($email,$role){
            $defaultPassword = '123456';
            $defaultPassword = password_hash($defaultPassword,PASSWORD_DEFAULT);

            if($this->adminModel->createNewAccount($email,$role,$defaultPassword)){
                echo 1;
            }else{
                echo 0;
            }

        }

        public function getUserSession(){
            if(!empty($_SESSION['user_id'])){
                return $_SESSION['user_id'];
            }else{
                return "none-user";
            }
        }
    }
?>