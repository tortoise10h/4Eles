<?php
    class Shops extends Controller{
        public function __construct(){
            $this->shopModel = $this->model('Shop');
        }

        public function index(){
            $this->view('shops/index');

            
        }

        public function showProducts($categoryID = ''){
            //FOR AJAX LOAD PRODUCT
            // echo $categoryID;
            $record_per_page = 9;
            $page = '';
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $page = $_POST['page'];
            }else{
                $page = 1;
            }

            $start_from = ($page - 1) * $record_per_page;

            $products = $this->shopModel->getLimitProducts($record_per_page,$start_from,$categoryID);

            $productArr = [];

            $i = 0;
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

            $totalProduct = $this->shopModel->getTotalProduct();
            $totalPages = ceil($totalProduct / $record_per_page);

            $result = [
                'products' => $productArr,
                'totalPages' => $totalPages,
                'pageActive' => $page
            ];
            
            echo json_encode($result);
        }

        
    }
?>