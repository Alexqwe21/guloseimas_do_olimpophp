<!DOCTYPE html>
<html lang="pt-br">

</html>


<head>
    <?php
    // Inclui o head
    require(__DIR__ . '/../../head_geral/head.php');

    ?>
</head>

<body>
    <header>


        <?php
        // Inclui o cabeçalho
        require(__DIR__ . '/../../template/header.php');
        ?>
    </header>

    <main>
        <form action="<?php echo BASE_URL . 'produtos/atualizarStatusB'; ?>" method="POST" class="form-group">
            <input type="hidden" name="id_banner" value="<?php echo $banner['id_banner']; ?>">

            <div class="form-group">
                <label for="status_banner">Status:</label>
                <select name="status_banner" id="status_banner" class="form-control">
                    <option value="Ativo" <?php echo $banner['status_banner'] === 'Ativo' ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Inativo" <?php echo $banner['status_banner'] === 'Inativo' ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                <a href="<?php echo BASE_URL . 'produtos/listar'; ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require(__DIR__ . '/../../template/footer.php');

        ?>
    </footer>


    </main>


    <?php
    // Inclui o script
    require(__DIR__ . '/../../script_geral/script.php');

    ?>

</body>

</html>