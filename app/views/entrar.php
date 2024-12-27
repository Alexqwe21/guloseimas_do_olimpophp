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
    <?php
        // Inclui o cabeçalho
        require('template/header.php');
    ?>
    </header>

    <main>

        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0] ['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Entrar</h2>
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
                <div class="lado_a_lado">
                    <div class="forms_contato">
                        <form   method="POST" action="http://localhost/guloseimas_do_olimpophp/public/entrar/entrar">
                            <div class="nome_entrar">

                                <div class="email_entrar">
                                    <div class="entrar_email">
                                        <label for="email">
                                        </label>
                                        <!-- Preenche o campo de email com o valor armazenado na sessão -->
                                        <input type="email" name="email_entrar" id="email_entrar" placeholder="Endereço de email"  required>
                                    </div>
                                    <label for="senha"></label>
                                    <input type="password" id="senha_entrar" name="senha_entrar" required placeholder="SENHA">

                                </div>
                                <div class="lembrar">

                                    <a href="#">Esqueceu a senha ? </a>
                                    <div class="checkbox">
                                        <input type="checkbox" id="lembrar" name="lembrar">
                                        <label for="lembrar">
                                            <p>lembrar email/senha</p>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="button_forms">
                                <button type="submit">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </section>

        <section class="brigadeiros">
            <article class="site">
                <div></div>

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
