<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL?>assets/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo BASE_URL?>assets/css/style.css"/>
</head>
<body>
    <header class="flex-center">
        <div id="container" class="container flex-between flex-align-center">
            <div class="logo">
              
            </div>
            <nav>
                <div class="nav">
                    <a href="<?php echo BASE_URL?>account">Meus Dados</a>
                    <a href="<?php echo BASE_URL?>login/logout">sair</a>
                </div>
            </nav>
        </div>    
    </header>

<?php
       $this-> loadViewInTemplate($viewName, $viewData);
?>
    <script src="<?php echo BASE_URL?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL?>assets/js/jquery.mask.min.js"></script>
    <script src="<?php echo BASE_URL?>assets/js/script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</body>
</html>