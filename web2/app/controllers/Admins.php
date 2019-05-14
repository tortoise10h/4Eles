<?php
    class Admins extends Controller{
        public function __construct(){
            $this->adminModel = $this->model('Admin');
            $this->shopModel = $this->model('Shop');
            $this->userModel = $this->model('User');
            $this->billModel = $this->model('Bill');
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

        public function getProductByID($productID){
            $product = $this->shopModel->getProductDetail($productID);
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
    }
?>