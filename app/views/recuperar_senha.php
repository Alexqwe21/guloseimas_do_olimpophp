<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/assets/css/style.css">
</head>
<body>

    <div class="container">
        <h2>Recuperar Senha</h2>
        <p>Digite seu e-mail cadastrado para receber uma nova senha.</p>

        <?php if (!empty($mensagem)) : ?>
            <p class="mensagem"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>Recuperarsenha/enviarEmail" method="POST">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
            
            <button type="submit">Enviar Nova Senha</button>
        </form>

        <a href="<?= BASE_URL ?>login">Voltar ao Login</a>
    </div>

</body>
</html>
