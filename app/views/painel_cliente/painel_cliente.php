<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    // Inclui o head

    require(__DIR__ . '/../head_geral/head.php');
    ?>

</head>

<body>

    <header>


        <?php
        // Inclui o cabeçalho
        require(__DIR__ . '/../template/header.php')
        ?>
    </header>


    <main>


        <section>
            <article class="site">
                <div class="perfil_cliente">
                    <div class="perfil_editar">
                        <h2>Perfil</h2>
                        <a href="#">Editar</a>
                    </div>

                    <div class="perfil_informaçoes">

                        <div class="informacoes">
                            <h3>Nome</h3>
                            <p>Alex</p>
                        </div>


                        <div class="informacoes">
                            <h3>Sobrenome</h3>
                            <p>Sandro</p>
                        </div>


                        <div class="informacoes">
                            <h3>CPF</h3>
                            <p>489.601.038-88</p>
                        </div>

                        <div class="informacoes">
                            <h3>E-mail</h3>
                            <p>alexsandropimenta16@gmail.com</p>
                        </div>

                        <div class="informacoes">
                            <h3>Telefone</h3>
                            <p>5511968812993</p>
                        </div>

                        <div class="informacoes_sair">

                            <a href="http://localhost/guloseimas_do_olimpophp/public/login/sair">Sair</a>
                        </div>
                        <div class="informacoes">
                            <h4>-------------------------------------------------------------------</h4>
                        </div>

                        <div class="perfil_editar">
                            <h2>Senha</h2>
                            <a href="#">Editar</a>
                        </div>

                        <div class="informacoes">

                            <h3>Senha</h3>
                            <p>5511968812993</p>
                        </div>



                    </div>





                </div>


                <div class="perfil_favoritos">
                    <div class="perfil_produtos_favortios">
                        <h2>Favoritos</h2>
                    </div>

                    <p>Não há itens em seus Favoritos.</p>

                </div>
            </article>
        </section>



    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require(__DIR__ . '/../template/footer.php');
        ?>
    </footer>

    <?php
    // Inclui o script
    require(__DIR__ . '/../script_geral/script.php');
    ?>

</body>

</html>