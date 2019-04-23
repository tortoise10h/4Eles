<?php
    /*
        * App core class
        * Creates Url & load core controller
        * Format url: /controller/method/params
    */

    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];
        
        public function __construct(){
           $url = $this->getUrl();
        //    print_r($url);

           //look in controller with first value of url array
           if(file_exists('../app/controllers/' . $url[0] . '.php')){
               //if file exists => controller exists then set that controller to current controller
               $this->currentController = ucwords($url[0]); //user ucwords because controller name is capitalize
               unset($url[0]);
           }

           require_once '../app/controllers/' . $this->currentController . '.php';

           //instantinate controller class
           $this->currentController = new $this->currentController;
           
           //check method exists inside controller with second value of url array
           if(isset($url[1])){
               if(method_exists($this->currentController,$url[1])){
                   $this->currentMethod = $url[1];
                   unset($url[1]);
               }
           }

           //get params
           $this->params = ($url) ? array_values($url) : [];

           //call a callback with an array of params
           call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
    }
?>