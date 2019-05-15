<?php
    class Users extends Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
        }   

        public function register(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $is_ok = true;
                
                //init data
                $data = [
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'email' => trim($_POST['email']),
                    'phone' => trim($_POST['phone']),
                    'sex' => trim($_POST['sex']),
                    'address' => trim($_POST['address']),
                    'password' => trim($_POST['password']),
                ];


                if($this->userModel->findUserByEmail($data['email'])){
                    $result = [
                        'alert' => '<p class="alert alert-danger">Your email is already exists</p>',
                        'status' => 'error'
                    ];
                    echo json_encode($result);
                    $is_ok = false;
                }

                if($is_ok == true){
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    if($this->userModel->register($data)){
                        $result = [
                            'alert' => '<p class="alert alert-success">Register Successfully.   </p>',
                            'status' => 'success'
                        ];
                        echo json_encode($result);
                    }else{
                        $result = [
                            'alert' => '<p class="alert alert-danger">Something went wrong so your account wasn\'t created. Try register again</p>',
                            'status' => 'error'
                        ];
                        echo json_encode($result);
                    }
                }
            }
        }

        public function login(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $is_ok = true;
                
                // init data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                ];
                if($this->userModel->findUserByEmail($data['email']) == false){
                    $result = [
                        'alert' => '<p class="alert alert-danger">Email or Password incorrect</p>',
                        'status' => 'error'
                    ];
                    echo json_encode($result);
                    $is_ok = false;
                }
                if($this->userModel->checkUserBlock($data['email']) == false){
                    $result = [
                        'alert' => '<p class="alert alert-danger">User was blocked</p>',
                        'status' => 'error'
                    ];
                    echo json_encode($result);
                    $is_ok = false;
                }
                if($is_ok == true){
                    $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                    if($loggedInUser){
                        //user found -> create session
                        $this->createUserSession($loggedInUser);
                        $result = [
                            'alert' => 'Successfully',
                            'status' => 'success'
                        ];
                        echo json_encode($result);
                    }else{
                        //user not found -> return error
                        $result = [
                            'alert' => '<p class="alert alert-danger">Email or Password incorrect</p>',
                            'status' => 'error'
                        ];
                        echo json_encode($result);
                    }
                }
            }
        }
        public function createUserSession($user){
            $userFullName = $user->firstname . " " . $user->lastname;

            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $userFullName;
            $_SESSION['user_role'] = $user->roleID;
        }
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_role']);
            header('Location: ' . URLROOT . '/pages/index');
        }
        public function isLogin(){
            $result = [];
            //Use echo for ajax call
            if(!empty($_SESSION['user_id'])){
                $result = [
                    'status' => 'true',
                    'userID' => $_SESSION['user_id']
                ];
            }else{
                $result = [
                    'status' => 'false',
                    'userID' => 'none'
                ];
            }
            echo json_encode($result);
        }
    }
?>