<!DOCTYPE html>
<html lang="pt-br">

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
        <?php
        // Verifica se o produto foi carregado corretamente
        if (isset($banner_produto)):
        ?>
            <div class="container">
                <h1>Editar Produto</h1>

                <!-- Formulário de edição do produto -->
                <form action="<?php echo BASE_URL . 'produtos/atualizar/' . $banner_produto['id_banner']; ?>" method="POST" enctype="multipart/form-data">



                    <div class="form-group">
                        <label for="nome_produto">Nome do banner</label>
                        <input type="text" id="nome_produto" name="nome_produto" value="<?php echo htmlspecialchars($banner_produto['nome_banner']); ?>" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="alt_foto_galeria">Texto Alternativo</label>
                        <input type="text" id="alt_foto_galeria" name="alt_foto_galeria" placeholder="Digite o texto alternativo" value="<?php echo htmlspecialchars($banner_produto['alt_foto_banner']); ?>" required class="form-control">
                    </div>




                    <div class="form-group">
                        <label for="foto_produto">Foto do Produto</label>
                        <input type="file" id="foto_produto" name="foto_produto" class="form-control">
                        <small>Deixe em branco para não alterar a imagem.</small>
                    </div>
                    <input type="hidden" name="foto_produto_antiga" value="<?php echo htmlspecialchars($banner_produto['foto_banner']); ?>">
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    <input type="hidden" name="id_produto" value="<?php echo $banner_produto['id_banner']; ?>">
                    <a href="<?php echo BASE_URL . 'produtos/banner_produto'; ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php else: ?>
            <p>Produto não encontrado.</p>
        <?php endif; ?>


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