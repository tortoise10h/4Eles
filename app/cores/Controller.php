<?php
    /*
        * Base controller
        * Every controller in controllers folder have to extend this controller
        * For load model and view
    */

    class Controller{
        //LOAD MODEL
        public function model($model){
            require_once '../app/models/' . $model . '.php';
            //instantiate model
            return new $model();
            //Eg: if Post was passed in, the it will return new Post()
        }
        
        //LOAD VIEW
        public function view($view, $data = []){
            //check for view file
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }else{
                die('Something went wrong, View doesn\'t exists!');
            }
        }
    }
?>