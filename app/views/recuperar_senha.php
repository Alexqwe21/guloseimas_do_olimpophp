<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>

</head>


<style>
        
.container{
    display: flex
;
    flex-direction: column;
    justify-content: end;
    align-items: anchor-center;
}

.container p{
    margin-bottom: 50px;
    font-size: 20pt;
    color: #985C41;
}


input {
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: 2px solid #985C4150;
    background-color: transparent;
    width: 300px;
    height: 30px;
    color: #985C41;
    font-size: 13pt;
    /* margin-bottom: 30px; */
    margin: 30px 0;
}

input::placeholder{
   color: #985C41;

}

form {
    display: flex
;
    flex-direction: column;
}


button {
    background-color: #9BE79E;
    letter-spacing: 3px;
    font-weight: 600;
    color: white;
    border: none;
    /* height: 50px; */
    width: 300px;
    height: 30px;
    font-size: 13pt;
    /* margin-bottom: 30px; */
    margin: 30px 0;
    height: 50px;
    border-radius: 10px;
    font-size:20pt;
}

input:focus {
    outline: none; /* Remove a borda de foco padrão */
   
}

</style>

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
                    <h2>Recuperar senha</h2>
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



                <div class="container">
        
        <p>Digite seu e-mail cadastrado para receber uma nova senha.</p>

        <?php if (!empty($mensagem)) : ?>
            <p class="mensagem"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>Recuperarsenha/enviarEmail" method="POST">
            <label for="email"></label>
            <input type="email" name="email" id="email" required placeholder='E-mail:'>
            
            <div class="button_forms">
                                <button type="submit">Enviar nova senha</button>
                            </div>
        </form>

        <a href="<?= BASE_URL ?>entrar">Voltar ao Login</a>
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