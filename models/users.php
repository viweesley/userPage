<?php

class users extends model{

    private $id_user;
    private $name;
    private $name_user;

    public function addUser($name, $name_user){
        $page = "addUser";
        if($this->validateNameUser($name_user, $page)){
            echo "5tjhb465hyg";
            $password = $name_user;
            $creation_date_user = date("Y-m-d H:i:s");
            $hash_password = $this->hashPasswordCreation($password, $creation_date_user);
            $this->addDbuser($name, $name_user, $hash_password, $creation_date_user);
        }else{
            $_SESSION['msg_register'] = "O nome de usuario já está sendo utilizado";
        }
    }

    public function addDbUser($name, $name_user, $hash_password, $creation_date_user){
        $sql = "INSERT INTO users (name, name_user, password, created_at) 
                            VALUES (:name, :name_user, :password, :created_at)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":name_user", $name_user);
        $sql->bindValue("password", $hash_password);
        $sql->bindValue(":created_at", $creation_date_user);
        $sql->execute();
      
        if($sql->rowCount() > 0){
            $_SESSION['msg_success'] = "Cadastro efetuado com sucesso";
        }

    }

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
                $data_user = $sql->fetch();
                $this->id_user = $data_user['id'];
                $this->name = $data_user['name'];
                $this->name_user = $data_user['name_user'];
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
        $sql = "UPDATE users
                SET token = :token WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id" ,$id);
        $sql->bindValue(":token", $token);
        $sql->execute();
    }

    private function updateDbUsersLastAccess($id){
        $data_access = date("Y-m-d H:i:s");
        $sql = "UPDATE users 
                SET last_access = :last_access";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":last_access", $data_access);
        $sql->execute();
    }

    public function logout(){
        unset($_SESSION['token_login']);
        header('location:'.BASE_URL);
    }

    public function getUser(){
        $sql = "SELECT * 
                FROM   users 
                WHERE  id = :id ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $this->id_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dada_user = $sql->fetch();
            return $dada_user;
            exit;
        }
    }

    public function setUser($name, $name_user){
        $page = "setUser";
        if($this->name_user == $name_user){
            $this->setDbUser($name, $name_user);
        }elseif($this->validateNameUser($name_user, $page)){
           $this->setDbUser($name, $name_user);
        }
    }

    private function setDbUser($name, $name_user){
        $update_date_user = date("Y-m-d H:i:s");
        $sql = "UPDATE users 
                SET name = :name, name_user = :name_user, updated_at = :update_date_user
                WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":name_user", $name_user);
        $sql->bindValue(":update_date_user", $update_date_user);
        $sql->bindValue(":id", $this->id_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            $_SESSION['msg_success'] = "Dados Alterados com sucesso!";
        }
    }

    private function validateNameUser($name_user, $page){
        if($this->lengthNameUser($name_user, $page)){
            if(!$this->UserNameEquals($name_user, $page)){
                return true;
            }
        }
        return false;
    }

    private function UserNameEquals($name_user, $page){
        $sql = "SELECT * FROM users WHERE name_user = :name_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name_user", $name_user);
        $sql->execute();

        if($sql->rowCount() > 0){
            if($page == "addUser") {
                $_SESSION['msg_error-register'] = "Já existe este nome de usuario!";
            }elseif($page == "setUser"){
                $_SESSION['msg_error'] = "Já existe este nome de usuario!";
            }
            return true;
        }
        return false;
    }

    private function lengthNameUser($name_user, $page){
        $user_name_length = strlen($name_user);
        if($user_name_length >= 5){
            return true;
        }else{
            if($page == "addUser") {
                $_SESSION['msg_error-register'] = "O nome de usuario tem que ter mais de 5 caracteres";
            }elseif($page == "setUser"){
                $_SESSION['msg_error'] = "O nome de usuario tem que ter mais de 5 caracteres";
            }
            return false;
        }
    }

}