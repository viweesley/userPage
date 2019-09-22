<?php

class accountController extends controller{

    private $users;

    public function __construct(){
       $this->users = new users();
       
       if(!$this->users->isLogged()){
           header("location:".BASE_URL."login");
       }
    }

    public function index(){
        $viewData = array(
            'msg' => '',
            'msg_success' => ''
        );

        if(!empty($_SESSION['msg_error'])){
            $viewData['msg'] = $_SESSION['msg_error'];
            unset($_SESSION['msg_error']);
        }

        if(!empty($_SESSION['msg_success'])){
            $viewData['msg_success'] = $_SESSION['msg_success'];
            unset($_SESSION['msg_success']);
        }

        $viewData['user'] = $this->users->getUser();
        $this->loadTemplate('account', $viewData);
    }

    public function setUser(){
        if(!empty($_POST['cadastro_sub'])){
            $name = addslashes($_POST['name']);
            $name_user = addslashes($_POST['name-user']);
            if(!empty($name) and !empty($name_user)){
                $this->users->setUser($name, $name_user);
            }else{
               $_SESSION['msg_error'] = "Todos os campo devem estar preenchidos!";
            }
        }
        header("location:".BASE_URL."account");
    }

    
}