<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>

</head>

<body>

    <header>
        <div class="site">
            <div class="logo_header">
                <h1><a href="index.html"> <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/logo_header.svg"
                            alt="Logo da Empresa - Guloseimas do olimpo"></a></h1>
            </div>
            <nav>
                <div class="mobile-menu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>

                <ul class="nav-list">
                    <div class="login_header">
                        <a href="login.html"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/login.svg" alt="Login"></a>
                    </div>
                    <li><a href="http://localhost/guloseimas_do_olimpophp/public/home">HOME</a></li>
                    <li><a href="http://localhost/guloseimas_do_olimpophp/public/sobre">SOBRE</a></li>
                    <li><a href="http://localhost/guloseimas_do_olimpophp/public/produtos">PRODUTOS</a></li>
                    <li><a href="http://localhost/guloseimas_do_olimpophp/public/compras">RESERVA</a></li>
                    <li><a href="http://localhost/guloseimas_do_olimpophp/public/galeria">GALERIA</a></li>
                    <li><a href="http://localhost/guloseimas_do_olimpophp/public/contato">CONTATO</a></li>
                    <li class="close-btn"><a href="#">FECHAR</a></li>
                </ul>
            </nav>

            <div class="login_header">
                <a href="login.html"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/login.svg" alt="Login"></a>
            </div>
        </div>
    </header>

    <main>

        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0] ['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Login</h2>
                </div>
            </article>
        </section>


        <section class="brigadeiros">
            <article class="site">
                <div>
                    <h2>Entrar ou criar conta</h2>
                </div>

                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 2.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 3.svg" alt="brigadeiros">
                </div>
            </article>
        </section>



        <section class="login_contato">
            <article class="site">
                <div class=" lado_a_lado">



                    <div class="forms_contato">
                        <form  method="POST" action="http://localhost/guloseimas_do_olimpophp/public/login/login" >
                            <div class="email">
                                <label for="email">
                                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/email_forms.svg"
                                        alt="telefone"></label>
                                <input type="email" name="email" id="email" placeholder="Endereço de email" required>
                            </div>

                           <!--   <div class="tipo_usuario">
                                <label for="tipo_usuario">Tipo de Usuário:</label>
                               <select name="tipo_usuario" id="tipo_usuario" required>
                                <option value="Selecione" disabled selected>Selecione</option>

                                    <option value="Funcionario">Funcionário</option>
                                    Outros tipos de usuários, se necessário 
                                </select> 
                            </div> -->

                            <div class="button_forms">
                                <button type="submit">CONTINUAR</button>
                            </div>
                        </form>



                    </div>
                </div>
            </article>
        </section>


        <section class="brigadeiros">
            <article class="site">
                <div>

                </div>

                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 4.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 5.svg" alt="brigadeiros">
                </div>
            </article>
        </section>



    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require('template/footer.php');
        ?>
    </footer>

    <?php
    // Inclui o script
    require('script_geral/script.php');
    ?>

</body>

</html>