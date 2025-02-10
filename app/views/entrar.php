<?php
// Verifica se há erro de login na sessão
$erroLogin = isset($_SESSION['login-erro']) ? $_SESSION['login-erro'] : null;
unset($_SESSION['login-erro']); // Limpa a variável após usar

// Caso haja erro de login, redireciona para a página de login com o parâmetro erro=true
if ($erroLogin) {
    header("Location: http://localhost/guloseimas_do_olimpophp/public/entrar/entrar?erro=true");
    exit();
}
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
                    <h2>Entrar ou criar conta</h2>
                </div>

                <div>
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 2.svg" alt="brigadeiros">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/BRIGADEIRO 3.svg" alt="brigadeiros">
                </div>
            </article>
        </section>

        <!-- Formulário de Login -->
        <section class="login_contato">
            <article class="site">
                <div class="lado_a_lado">
                    <div class="forms_contato">
                        <form method="POST" action="http://localhost/guloseimas_do_olimpophp/public/entrar/entrar">
                            <div class="nome_entrar">
                                <div class="email_entrar">
                                    <div class="entrar_email">
                                        <label for="email"></label>
                                        <!-- Preenche o campo de email com o valor armazenado na sessão -->
                                        <input type="email" name="email_entrar" id="email_entrar" placeholder="Endereço de email" required>
                                    </div>

                                    <label for="senha"></label>
                                    <div style="position: relative; display: flex; align-items: center;">
                                        <input type="password" id="senha_entrar" name="senha_entrar" required placeholder="Senha" style="text-transform: none; padding-right: 40px;">
                                        <button type="button" id="toggleSenha" style="position: absolute; right: 10px; background: none; border: none; cursor: pointer;">
                                            👁️
                                        </button>
                                    </div>
                                </div>

                                <div class="lembrar">
                                    <a href="http://localhost/guloseimas_do_olimpophp/public/Recuperarsenha/">Esqueceu a senha?</a>
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

                            <!-- Modal de Erro -->
                            <div class="modal fade" id="modalErro" tabindex="-1" aria-labelledby="modalErroLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalErroLabel">Erro</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>O email ou a senha estão incorretos. Por favor, tente novamente.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form'); // Seleciona o formulário
        const modalErro = new bootstrap.Modal(document.getElementById('modalErro')); // Seleciona o modal de erro

        // Verifica se existe o parâmetro 'erro' na URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('erro') && urlParams.get('erro') === 'true') {
            modalErro.show(); // Exibe o modal de erro se o login falhou
        }

        // Adiciona o evento de submit no formulário de login
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // Impede o envio tradicional do formulário

            // Aqui você pode colocar o código para enviar via AJAX, se necessário, ou redirecionar
            form.submit(); // Submete o formulário após a execução do código
        });
    });
</script>

</html>
