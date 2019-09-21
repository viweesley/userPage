<?php

class users extends model{

    public function isLogged(){
        if(!empty($_SESSION['token_login'])){
            $token_login = $_SESSION['token_login'];
            if($this->getTokenLogin($token_login)) return true;
        }
        return false;
    }


    private function getTokenLogin($token_login){
        if(!empty($token_login)){
            $sql = "SELECT * FROM users WHERE token = :token";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":token", $token_login);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dada_user = $sql->fetch();
                $this->id_user = $dada_user['id'];
                return true;
            }
        }
        return false;
    }

    public function login($name_user, $password){
        $id = $this->getId($name_user);
        $creation_date_user = $this->getDateCreated($id);
        $hash_password = $this->hashPasswordCreation($password, $creation_date_user);
        $sql = "SELECT id 
                FROM  users 
                WHERE name_user = :name_user
                      AND password = :hash_password";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name_user", $name_user);
        $sql->bindValue(":hash_password", $hash_password);
        $sql->execute();
        echo $id;
        echo $creation_date_user;
        echo $hash_password;

        if($sql->rowCount() > 0){
            $dada_user = $sql->fetch();
            $this->id_user = $dada_user['id'];
            $token = $this->createTokenLogin($id);
            $this->updateDbUsersLastaccess($id);
            $_SESSION['token_login'] = $token;
        }else{
            $_SESSION['msg_error'] = "Nome de usuário ou senha incorreto!";
        }
        return false;
    }

    public function getId($name_user){
        $sql = "SELECT id 
                FROM users
                WHERE name_user = :name_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name_user", $name_user);
        $sql->execute(); 
        
        if($sql->rowCount() > 0){
            $data_user = $sql->fetch()['id'];
            return $data_user;
        } 
    }
    
    private function getDateCreated($id){
        $sql = "SELECT created_at 
                FROM  users 
                WHERE id = :id ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $creation_date_user = $sql->fetch()['created_at'];
            return $creation_date_user;
        }
    }

    private function hashPasswordCreation($password, $creation_date_user){
        $iterations = 1854;
        $salt = $creation_date_user;
        $hash_password = hash_pbkdf2("md5", $password, $salt, $iterations, 34);
        return $hash_password;
    }

    public function createTokenLogin($id){
        $token = $this->genereteTokenLogin($id);
        $this->addDbTokenLogin($id, $token);
        return $token;      
    }

    private function genereteTokenLogin($id){
        $token = md5(rand(1, 100).date("Y-m-d H:i:s").rand(1, 100).$id);
        return $token;
    }

    private function addDbTokenLogin($id, $token){
        $sql = "UPDATE users SET token = :token WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id" ,$id);
        $sql->bindValue(":token", $token);
        $sql->execute();
    }

    private function updateDbUsersLastAccess($id){
        $data_access = date("Y-m-d H:i:s");
        $sql = "UPDATE users SET last_access = :last_access";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":last_access", $data_access);
        $sql->execute();
    }

    public function logout(){
        unset($_SESSION['token_login']);
        header('location:'.BASE_URL);
    }

}