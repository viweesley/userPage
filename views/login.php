<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL?>assets/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL?>assets/css/style.css"/>
</head>
<body>
<section class="user_action flex-center">
    <div class="container">
        <div class="content-2 flex-between flex-align-start">
            <div class="item-2">
                <div class="login item_content-form flex-center flex-align-center">
                <div class="title title-small">
                    <h2>Faça seu Login</h2>
                    <h3></h3>
                </div>
                <?php if(isset($msg) and !empty($msg)): ?>
                    <div class="msg">
                        <p><?php echo ($msg);?></p>
                    </div>
                <?php endif; ?>             
                    <form method="POST" action="<?php echo BASE_URL?>login/login_action" id="form-contato" onsubmit="return validarLogin(this);">
                        <div class="group-input">
                            <label for="name-user-login">Nome de Usuario:</label>
                            <input type="text" name="name-user" class="campo" id="name-user-login">
                        </div>
                        <div class="group-input">
                            <label for="senha">Senha:</label>
                            <input type="password" name="password" class="campo" id="password">
                        </div>
                        <div class="group-input flex-align-end">
                            <input type="submit" value="Entrar" name="entrar-sub" class="bnt bnt-entrar">
                        </div>
                        <div class="group-input">
                            <a href="<?php echo BASE_URL."login/resetPassword"?>">Esqueceu sua senha?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="item-2">
                <div class="cadastro item_content-form flex-center flex-align-center">
                <div class="title title-small">
                    <h2>Faça seu Cadastro</h2>
                    <h3></h3>
                </div>
                <?php if(isset($msg_success) and !empty($msg_success)): ?>
                    <div class="msg msg__success">
                        <p><?php echo ($msg_success);?></p>
                    </div>
                <?php endif; ?>   
                <?php if(isset($msg_register) and !empty($msg_register)): ?>
                    <div class="msg">
                        <p><?php echo ($msg_register);?></p>
                    </div>
                <?php endif; ?>
                    <form method="POST" action="<?php echo BASE_URL?>login/addUser" onsubmit="return valideRegister(this);">
                        <div class="group-input">
                            <label for="name-cadastro">Nome Completo:</label>
                            <input type="text" name="name" class="campo" id="name-cadastro">
                        </div>
                        <div class="group-input">
                        <label for="name-user">Nome de Usuario:</label>
                            <input type="text" name="name-user" class="campo" id="name-user">
                        </div>
                        <div class="group-input flex-align-end">
                            <input type="submit" name="cadastro_sub" value="Proximo" class="bnt bnt-cadastro">  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo BASE_URL?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL?>assets/js/jquery.mask.min.js"></script>
    <script src="<?php echo BASE_URL?>assets/js/script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</body>
</html>

