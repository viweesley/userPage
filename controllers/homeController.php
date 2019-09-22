<?php

class homeController extends controller{

    public function __construct(){
       $users = new users();
       
       if(!$users -> isLogged()){
           header("location:".BASE_URL."login");
       }
    }

    public function index(){
        $viewData = array();
        $this->loadTemplate('home', $viewData);
    }
}