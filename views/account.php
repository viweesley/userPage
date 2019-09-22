<section class="account flex-center">
    <div class="container flex-between">
        <div class="account-content flex-between w-100">
            <aside class="user_left">
                <div class="user_option">
                    <div class="user_photo">
                        <div class="photo">
                            
                        </div>
                        <div class="dados">
                            <?php echo $user['name'] ?>
                        </div>
                    </div>

                    <div class="links-user">
                        <a  href="<?php echo BASE_URL;?>account">
                            <div class="menu-item active_account">
                            <i class="fas fa-user"></i>Meus dados 
                            </div>
                        </a>
                        <a  href="<?php echo BASE_URL;?>">
                            <div id="link-logout" class="menu-item">
                                <i class="fas fa-power-off"></i>Sair
                            </div>
                        </a>
                    </div>  
                </div>
            </aside> 
            <section class="account_data">
                <div class="title-medium">
                    <h1>Dados do Usuario</h1>
                </div>
                <?php if(!empty($msg)): ?>
                    <div class="msg">
                       <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($msg_success)):?>
                    <div class="msg msg__success">
                        <?php echo $msg_success; ?>
                    </div>
                <?php endif; ?>
                <div class="">
                    <form action="<?php echo BASE_URL ?>account/setUser" method="post">
                        <div class="row">
                            <div class="group-input">
                                <label for="name">Nome Completo:</label>
                                <input type="text" name="name" class="campo" id="name" autocomplete="off" value="<?php echo $user['name'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="group-input">
                                <label for="name-user">Nome Usuario:</label>
                                <input type="text" name="name-user" class="campo" id="name-user" autocomplete="off" value="<?php echo $user['name_user'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="group-input group-submit flex-align-start">
                                <button type="submit" name="cadastro_sub" value="/" class="bnt bnt-cadastro">Altera Dados</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>