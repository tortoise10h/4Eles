<?php
    class Shops extends Controller{
        public function __construct(){
            $this->shopModel = $this->model('Shop');
        }

        public function index(){
            $categoryQuantity = $this->shopModel->countCategoryQuantity();
            $this->view('shops/index',$categoryQuantity);
        }

        public function productDetail($categoryID,$productID){
            $product = $this->shopModel->getProductDetail($productID);
            $data = [
                'product' => $product,
                'categoryID' => $categoryID
            ];
            $this->view('shops/product-detail',$data);
        }
        
        public function showProducts($categoryID,$page = 1){
            //FOR AJAX LOAD PRODUCT

            $record_per_page = 9;

            $page = (int) $page;
           
            //for SELECT statement in Shop model
            $start_from = ($page - 1) * $record_per_page;
            
            $products = $this->shopModel->getLimitProducts($record_per_page,$start_from,$categoryID);
            
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
                ];
            }
            
            $totalProduct = $this->shopModel->countProduct($categoryID);
            $totalPages = ceil($totalProduct / $record_per_page);
            
            $result = [
                'products' => $productArr,
                'totalPages' => $totalPages,
                'pageActive' => $page,
                'categoryID' => $categoryID
            ];
            
            echo json_encode($result);
        }

        public function showSearchProducts($categoryID,$page = 1,$searchValue,$price,$color,$sort){
            $searchValue = str_replace('--',' ',$searchValue);
            // echo "Search value in shops controller: " . $searchValue;
            if($searchValue == 'search-all'){
                $searchValue = '';
            }   
            //FOR AJAX LOAD PRODUCT
            $record_per_page = 9;
           
            //for SELECT statement in Shop model
            $start_from = ($page - 1) * $record_per_page;
            
            $products = $this->shopModel->getLimitSearchProducts($record_per_page,$start_from,$categoryID,$searchValue,$price,$color,$sort);
            
            // echo $products;

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
                ];
            }
            
            $totalProduct = $this->shopModel->countSearchProduct($categoryID,$searchValue,$price,$color);
            $totalPages = ceil($totalProduct / $record_per_page);
            
            $result = [
                'products' => $productArr,
                'totalPages' => $totalPages,
                'pageActive' => $page,
                'categoryID' => $categoryID
            ];
            
            echo json_encode($result);
        }

        public function getAllProducts(){
            $products = $this->shopModel->getAllProducts();

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
                ];
            }

            echo json_encode($productArr);
        }

        public function addToCart($productID,$quantity,$userID){
            $quantity = (int)$quantity;
            if(!empty($_SESSION['cart-product'])){
                // echo 'SESSION IS NOT EMPTY';
                $cartProducts = $_SESSION['cart-product'];
                $duplicateProductIndex = -1;
                //CHECK FOR DUPLICATE PRODUCT
                for($i = 0; $i < count($cartProducts); $i++){
                    if($cartProducts[$i]['productID'] == $productID && $cartProducts[$i]['userID'] == $userID){
                        $duplicateProductIndex = $i;
                        break;
                    }
                }
                if($duplicateProductIndex == -1){
                    //new product is not duplicate with another
                    $cartProducts[] = [
                        'productID' => $productID,
                        'quantity' => $quantity,
                        'userID' => $userID
                    ];
                }else{
                    //duplicate product -> just set new quantity
                    $oldQuantity = (int)$cartProducts[$duplicateProductIndex]['quantity'];
                    $newQuantity = $oldQuantity + (int)$quantity;
                    $cartProducts[$duplicateProductIndex]['quantity'] = $newQuantity;
                }
                $_SESSION['cart-product'] = $cartProducts;
                $test = $_SESSION['cart-product'];
                echo json_encode($test);
            }else{
                // echo 'SESSION empty';
                $cartProducts = [];
                $cartProducts[] = [
                    'productID' => $productID,
                    'quantity' => $quantity,
                    'userID' => $userID
                ];
                $_SESSION['cart-product'] = $cartProducts;
                $test = $_SESSION['cart-product'];
                echo json_encode($test);
            }
            // unset($_SESSION['cart-product']);

        }
        
    }
?>