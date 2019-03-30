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
    }
?>