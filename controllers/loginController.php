<?php

class loginController extends controller{

    public function __construct(){
        $users = new users();
        if($users -> isLogged()){
            header("location:".BASE_URL);
        }
    }

    public function index(){
        $viewData = array(
            'msg' => '',
            'msg_register' => '',
            'msg_success' => ''
        );

        if(!empty($_SESSION['msg_error'])){
            $viewData['msg'] = $_SESSION['msg_error'];
            unset($_SESSION['msg_error']);
        }
 
        if(!empty($_SESSION['msg_error-register'])){
            $viewData['msg_register'] = $_SESSION['msg_error-register'];
            unset($_SESSION['msg_error-register']);
        }
 
        if(!empty($_SESSION['msg_success'])){
            $viewData['msg_success'] = $_SESSION['msg_success'];
            unset($_SESSION['msg_success']);
        }
    
        $this->loadView('login', $viewData);   
    }


    public function login_action(){
        if(!empty($_POST['entrar-sub'])){
            $name_user = addslashes($_POST['name-user']);
            $password = addslashes($_POST['password']);

            if(!empty($name_user) and !empty($password)){
                $users = new users();
                $users->login($name_user, $password);
            }else{
                $_SESSION['msg_error'] = "Todos os campo devem estar preenchidos!";
            }
        }
        header("location:".BASE_URL);
    }

    public function logout(){
        $users = new users();
        $users->logout();
    }

}
