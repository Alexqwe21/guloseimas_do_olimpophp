<script>
    document.addEventListener('DOMContentLoaded', function() {
        let erroLogin = "<?php echo isset($_SESSION['login-erro']) ? $_SESSION['login-erro'] : ''; ?>";

        if (erroLogin) {
            let modalErro = new bootstrap.Modal(document.getElementById('modalErro'));
            document.getElementById('mensagemErro').innerText = erroLogin;
            modalErro.show();
        }
    });
</script>

<?php

$erroLogin = isset($_SESSION['login-erro']) ? $_SESSION['login-erro'] : null;
unset($_SESSION['login-erro']); // Limpa a sessão para não mostrar sempre
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>
</head>

<style>
    input[type="email"],
    input[type="password"] {
        text-transform: normal !important;
    }

    input[type="password"] {
        text-transform: normal !important;
    }

    #senha_entrar {
        text-transform: normal !important;
    }
</style>

<body>
    <header>
        <?php
        // loader
        require('template/loader.php');

        // Inclui o cabeçalho
        require('template/header.php');
        ?>
    </header>

    <main>
        <!-- Banner -->
        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0]['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Entrar</h2>
                </div>
            </article>
        </section>

        <!-- Informações adicionais -->
        <section class="brigadeiros">
            <article class="site">
                <div>
                    <h2>Entrar</h2>
                </div>

                <div>
                    <img src="assets/img/BRIGADEIRO 2.svg" alt="brigadeiros">
                    <img src="assets/img/BRIGADEIRO 3.svg" alt="brigadeiros">
                </div>
            </article>
        </section>

        <!-- Formulário de Login -->
        <section class="login_contato">
            <article class="site">
                <div class="lado_a_lado">
                    <div class="forms_contato">
                        <form method="POST" action="entrar/entrar">
                            <div class="nome_entrar">
                                <div class="email_entrar">
                                    <div class="entrar_email">
                                        <label for="email"></label>
                                        <!-- Preenche o campo de email com o valor armazenado na sessão ou passado pela URL -->
                                        <input type="email" name="email_entrar" id="email" placeholder="Endereço de email"
                                            value="<?= isset($_SESSION['emailTemp']) ? htmlspecialchars($_SESSION['emailTemp']) : ''; ?>"
                                            required autocomplete="off">
                                    </div>
                                </div>

                                <!-- Outros campos, como senha, etc. -->
                                <div class="entrar_email">
                                    <label for="senha"></label>
                                    <input type="password" id="senha" name="senha_entrar" required placeholder="Senha">
                                </div>

                                <!-- Outros campos, como lembrar senha, etc. -->
                                <div class="lembrar">
                                    <a href="/Recuperarsenha/">Esqueceu a senha?</a>
                                    <div class="checkbox">
                                        <input type="checkbox" id="lembrar" name="lembrar">
                                        <label for="lembrar">
                                            <p>Lembrar email/senha</p>
                                        </label>
                                    </div>
                                </div>
                            </div>





                            <div class="button_forms">
                                <button type="submit">Entrar</button>
                            </div>

                            <!-- Modal de Erro -->

                        </form>
                    </div>
                </div>
            </article>
        </section>

        <!-- Imagens adicionais -->
        <section class="brigadeiros">
            <article class="site">
                <div></div>
                <div>
                    <img src="assets/img/BRIGADEIRO 4.svg" alt="brigadeiros">
                    <img src="assets/img/BRIGADEIRO 5.svg" alt="brigadeiros">
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


    <div class="modal fade" id="modalErro" tabindex="-1" aria-labelledby="modalErroLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalErroLabel">Erro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="mensagemErro"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalSucessoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSucessoLabel">Sucesso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="mensagemSucesso"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>





</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verifique se há uma mensagem de erro na sessão e exiba o modal
        let erroLogin = "<?php echo isset($_SESSION['login-erro']) ? $_SESSION['login-erro'] : ''; ?>";
        if (erroLogin) {
            let modalErro = new bootstrap.Modal(document.getElementById('modalErro'));
            document.getElementById('mensagemErro').innerText = erroLogin; // Exibe a mensagem de erro no modal
            modalErro.show();
        }

        // Verifique se há uma mensagem de sucesso na sessão e exiba o modal
        let sucessoConta = "<?php echo isset($_SESSION['sucesso']) ? $_SESSION['sucesso'] : ''; ?>";
        if (sucessoConta) {
            let modalSucesso = new bootstrap.Modal(document.getElementById('modalSucesso'));
            document.getElementById('mensagemSucesso').innerText = sucessoConta; // Exibe a mensagem de sucesso no modal
            modalSucesso.show();
        }

        // Limpa a mensagem de erro quando o modal de erro for fechado
        $('#modalErro').on('hidden.bs.modal', function() {
            $('#mensagemErro').text(''); // Limpa a mensagem de erro
        });

        // Limpa a mensagem de sucesso quando o modal de sucesso for fechado
        $('#modalSucesso').on('hidden.bs.modal', function() {
            $('#mensagemSucesso').text(''); // Limpa a mensagem de sucesso
        });
    });
</script>

<script>
    document.getElementById('toggleSenha').addEventListener('click', function() {
        let inputSenha = document.getElementById('senha_entrar');
        if (inputSenha.type === 'password') {
            inputSenha.type = 'text';
            this.textContent = '👁️'; // Ícone para mostrar a senha
        } else {
            inputSenha.type = 'password';
            this.textContent = '🙈'; // Ícone para esconder a senha
        }
    });
</script>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        let links = document.querySelectorAll(".nav-link");
        let currentUrl = window.location.href;

        links.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add("ativo");
            }
        });
    });
</script>
</body>


</html>