<?php
    class Checkouts extends Controller{
        public function __construct(){
            $this->checkoutModel = $this->model('Checkout');
            $this->userModel = $this->model('User');
            $this->cartModel = $this->model('Cart');
            $this->billModel = $this->model('Bill');
        }

        public function index(){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            $currentUserCartProducts = $this->getCurrentUserCartProducts($currentUser['id']);

            if($this->checkUserCartEmpty($currentUser['id'])){
                $result = [
                    'currentUser' => $currentUser,
                    'currentUserCartProducts' => $currentUserCartProducts
                ];
                $this->view('checkouts/index',$result);
                
            }else{
                header('Location:' . URLROOT . '/pages/index');
            }
        }

        public function payment($firstName,$lastName,$address,$phone){
            $placeOrderInfo = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'address' => $address,
                'phone' => $phone
            ];
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            $currentUserCartProducts = $this->getCurrentUserCartProducts($currentUser['id']);
            if($this->checkUserCartEmpty($currentUser['id'])){
                $result = [
                    'currentUser' => $currentUser,
                    'currentUserCartProducts' => $currentUserCartProducts,
                    'placeOrderInfo' => $placeOrderInfo
                ];
                $this->view('checkouts/payment',$result);
            }else{
                header('Location:' . URLROOT . '/pages/index');
            }
        }

        public function thankyou($paymentName){
            $result = [
                'paymentName' => $paymentName
            ];
            $this->view('checkouts/thankyou',$result);
        }

        public function getCurrentUserAndParseToAssocArr(){
            $userId = $this->getUserSession();
            $user = $this->userModel->getUserInfoById($userId);
            $result = [
                'id' => $userId,
                'email' => $user->email,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'phone' => $user->phone,
                'address' => $user->address,
                'sex' => $user->sex,
                'password' => $user->password
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

        public function getCurrentUserCartProducts($userID){
            $cartProducts = [];
            $currentUserCartProducts = [];

            $cartProducts = $_SESSION['cart-product'];

            foreach($cartProducts as $cartProduct){
                if($cartProduct['userID'] == $userID){
                    $product = $this->cartModel->getProduct($cartProduct['productID']);
                    $result = [];
                    $result = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $cartProduct['quantity']
                    ];

                    $currentUserCartProducts[] = $result;
                }
            }

            return $currentUserCartProducts;
        }

        public function checkUserCartEmpty($userId){
            $cartProducts = [];
            if(isset($_SESSION['cart-product'])){
                $cartProducts = $_SESSION['cart-product'];
            
                $userCartProducts = [];

                foreach($cartProducts as $product){
                    if($product['userID'] == $userId){
                        $userCartProducts[] = $product;
                    }
                }
            
                if(count($userCartProducts) > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function saveBill($userID,$billID){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            $currentUserCartProducts = $this->getCurrentUserCartProducts($userID);
            
            $totalPrice = 0;
            foreach($currentUserCartProducts as $product){
                $totalPrice += ((int)$product['quantity'] * (int)$product['price']);
            }

            $bill = [
                'billID' => $billID,
                'customerID' => $userID,
                'totalPrice' => $totalPrice
            ];

            $billDetailList = $this->createBillDetaiList($userID,$billID);

            $this->billModel->saveBill($bill);
            $this->billModel->saveBillDetail($billDetailList);

            $this->deleteUserCartProducts($userID);

        }

        public function createBillDetaiList($userID,$billID){
            $currentUserCartProducts = $this->getCurrentUserCartProducts($userID);
            $billDetailList = [];
            
            foreach($currentUserCartProducts as $product){
                $billDetail = [
                    'billID' => $billID,
                    'productID' => $product['id'],
                    'quantity' => $product['quantity'],
                    'totalPrice' => ((int)$product['quantity'] * (int)$product['price'])
                ];

                $billDetailList[] = $billDetail;
            }

            return $billDetailList;
        }

        public function deleteUserCartProducts($userID){
            $cartProducts = [];
            if(!empty($_SESSION['cart-product'])){
                $cartProducts = $_SESSION['cart-product'];
                $cartProductsLength = count($cartProducts);
                for($i = 0; $i < $cartProductsLength; $i++){
                    if($cartProducts[$i]['userID'] == $userID){
                        unset($cartProducts[$i]);
                    }
                }
                $cartProducts = array_values($cartProducts);
                $_SESSION['cart-product'] = $cartProducts;
            }
        }

    }
?>