<?php
    class Checkouts extends Controller{
        public function __construct(){
            $this->checkoutModel = $this->model('Checkout');
            $this->userModel = $this->model('User');
            $this->cartModel = $this->model('Cart');
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

        public function payment(){
            $currentUser = $this->getCurrentUserAndParseToAssocArr();
            $currentUserCartProducts = $this->getCurrentUserCartProducts($currentUser['id']);
            if($this->checkUserCartEmpty($currentUser['id'])){
                $result = [
                    'currentUser' => $currentUser,
                    'currentUserCartProducts' => $currentUserCartProducts
                ];
                $this->view('checkouts/payment',$result);
            }else{
                header('Location:' . URLROOT . '/pages/index');
            }
        }

        public function thankyou(){
            $this->view('checkouts/thankyou');
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
    }
?>