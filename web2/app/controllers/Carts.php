<?php
    class Carts extends Controller{
        public function __construct(){
            $this->cartModel = $this->model('Cart');
        }

        public function index(){
            $this->view('carts/index');
        }

        public function getCartQuantity($userID){
            $quantity = 0;
            $cartProducts = [];
            if(!empty($_SESSION['user_id'])){
                if(!empty($_SESSION['cart-product'])){
                    $cartProducts = $_SESSION['cart-product'];
                    for($i = 0; $i < count($cartProducts); $i++){
                        if($cartProducts[$i]['userID'] == $userID){
                            $quantity++;
                        }
                    }
                }
            }
            echo $quantity;
        }

        public function getUserCartProduct($userID){
            $result = [];
            $cartProducts = [];
            if(!empty($_SESSION['cart-product'])){
                $cartProducts = $_SESSION['cart-product'];
                for($i = 0; $i < count($cartProducts); $i++){
                    if($cartProducts[$i]['userID'] == $userID){
                        $product = $this->cartModel->getProduct($cartProducts[$i]['productID']);
                        $result[] = [
                            'id' => $product->id,
                            'imgLink' => $product->imgLink,
                            'name' => $product->name,
                            'price' => $product->price,
                            'quantity' => $cartProducts[$i]['quantity']
                        ];
                    }
                }
            }

            if(empty($result)){
                echo 'false';
            }else{
                echo json_encode($result);
            }
        }

        public function changeProductQuantity($productID, $userID, $operation){
            $cartProducts = [];
            $quantity;
            if(!empty($_SESSION['cart-product'])){
                $cartProducts = $_SESSION['cart-product'];
                for($i = 0; $i < count($cartProducts); $i++){
                    if($cartProducts[$i]['productID'] == $productID && $cartProducts[$i]['userID'] == $userID){
                        if($operation == 'add'){
                            $quantity = (int) $cartProducts[$i]['quantity'];
                            $quantity++;
                            $cartProducts[$i]['quantity'] = $quantity;      
                        }else if($operation == 'sub'){
                            $quantity = (int) $cartProducts[$i]['quantity'];
                            $quantity--;
                            $cartProducts[$i]['quantity'] = $quantity;      
                        }
                    }
                }
                $_SESSION['cart-product'] = $cartProducts;
            }
        }

        public function removeCartProduct($productID,$userID){
            $cartProducts = [];
            if(!empty($_SESSION['cart-product'])){
                $cartProducts = $_SESSION['cart-product'];
                $pos = -1;
                for($i = 0; $i < count($cartProducts); $i++){
                    if($cartProducts[$i]['productID'] == $productID && $cartProducts[$i]['userID'] == $userID){
                        $pos = $i;
                    }
                }
                if($pos != -1){
                    unset($cartProducts[$pos]);
                    $cartProducts = array_values($cartProducts);
                }
                $_SESSION['cart-product'] = $cartProducts;
            }
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
                    echo 1;
                }else{
                    echo 0;
                }
            }else{
                echo 0;
            }
        }
    }
?>