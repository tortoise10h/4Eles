<?php
    class Searches extends Controller{
        public function __construct(){
            $this->searchModel = $this->model('Search');
            $this->shopModel = $this->model('Shop');
        }
        public function index(){
            // $searchValue = '';
            // if(isset($_GET['search'])){
            //     $searchValue = $_GET['search'];
            // }
            // if(isset($_GET['page'])){
            //     $page = $_GET['page'];
            // }
            // // $searchValue = utf8_encode($searchValue);
            // echo $searchValue;
            // $products = $this->searchModel->getSearchResult(9,1,$searchValue);
            // // print_r($products);
            $categoryQuantity = $this->shopModel->countCategoryQuantity();
            $this->view('searches/index',$categoryQuantity);
        }

        public function getSearchProducts(){
            $searchValue = '';
            $page = 1;
            if(isset($_GET['search'])){
                $searchValue = htmlspecialchars($_GET['search']);
            }
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }

            // echo "Search value: " . $searchValue . " | page: " . $page;
            $page = (int) $page; 

            //FOR AJAX LOAD PRODUCT
            $record_per_page = 9;
           
            //for SELECT statement in Shop model
            $start_from = ($page - 1) * $record_per_page;
            
            $products = $this->searchModel->getSearchResult($record_per_page,$start_from,$searchValue);
            

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
            
            $totalProduct = $this->searchModel->countTotalSearchProducts($searchValue);
            $totalPages = ceil($totalProduct / $record_per_page);
            
            $result = [
                'products' => $productArr,
                'totalPages' => $totalPages,
                'pageActive' => $page,
            ];
            

            echo json_encode($result);
        }
    }
?>