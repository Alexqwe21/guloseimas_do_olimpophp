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
                         
                        <a href="#">Sair</a>
                        </div>



                    </div>
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