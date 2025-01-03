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

        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0]['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Criar conta</h2>
                </div>
            </article>
        </section>

        <section class="brigadeiros">
            <article class="site">
                <div>
                    <h2>Criar conta</h2>
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
                        <form method="POST" action="<?php echo BASE_URL; ?>criarconta/salvar">
                            <div class="nome_entrar">

                                <div class="email_entrar">
                                    <div class="entrar_email">
                                        <label for="email">
                                        </label>
                                        <!-- Preenche o campo de email com o valor armazenado na sessão ou passado pela URL -->
                                        <input type="email" name="email" id="email" placeholder="Endereço de email"
                                            value=""
                                            required>
                                    </div>
                                </div>

                                <div class="entrar_email">
                                    <label for="nome"></label>
                                    <input type="text" name="nome" id="nome" placeholder="NOME" required>
                                </div>

                                <div class="email_entrar">
                                    <label for="cpf"></label>
                                    <input type="text" id="cpf" name="cpf" required placeholder="CPF ">
                                </div>

                                <div class="email_entrar">
                                    <label for="data_nascimento"></label>
                                    <input type="date" id="data_nascimento" name="data_nascimento" required placeholder="DATA DE NASCIMENTO">
                                </div>

                                <div class="email_entrar">
                                    <label for="telefone"></label>
                                    <input type="tel" id="telefone" name="telefone" required placeholder="TELEFONE">
                                </div>

                                <div class="email_entrar">
                                    <label for="endereco"></label>
                                    <input type="text" id="endereco" name="endereco" required placeholder="ENDEREÇO">
                                </div>

                                <div class="email_entrar">
                                    <label for="bairro"></label>
                                    <input type="text" id="bairro" name="bairro" required placeholder="BAIRRO">
                                </div>

                                <div class="email_entrar">
                                    <label for="cidade"></label>
                                    <input type="text" id="cidade" name="cidade" required placeholder="CIDADE">
                                </div>

                                <div class="email_entrar">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado" required>
                                        <option value="">Selecione o Estado</option>
                                        <?php foreach ($Estado as $estado): ?>
                                            <option value="<?= $estado['sigla_uf']; ?>"><?= $estado['sigla_uf']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="email_entrar">
                                    <label for="senha"></label>
                                    <input type="password" id="senha" name="senha" required placeholder="SENHA">
                                </div>

                                <div class="email_entrar">
                                    <label for="confirmar_senha"></label>
                                    <input type="password" id="confirmar_senha" name="confirmar_senha" required placeholder="CONFIRMAR SENHA">
                                </div>

                            </div>

                            <div class="button_forms">
                                <button type="submit">Criar Conta</button>
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