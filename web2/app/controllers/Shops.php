<?php
    class Shops extends Controller{
        public function __construct(){
            $this->shopModel = $this->model('Shop');
        }

        public function index(){
            $this->view('shops/index');
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
        
    }
?>