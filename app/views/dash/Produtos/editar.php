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
        if (isset($produto)):
        ?>
            <div class="container">
                <h1>Editar Produto</h1>

                <!-- Formulário de edição do produto -->
                <form action="<?php echo BASE_URL . 'produtos/atualizar/' . $produto['id_produto']; ?>" method="POST" enctype="multipart/form-data">


                
                    <div class="form-group">
                        <label for="nome_produto">Nome do Produto</label>
                        <input type="text" id="nome_produto" name="nome_produto" value="<?php echo htmlspecialchars($produto['nome_produto']); ?>" required class="form-control">
                    </div>

                     <div class="form-group">
                        <label for="descricao_produto">Descrição</label>
                        <textarea id="descricao_produto" name="descricao_produto" required class="form-control"><?php echo htmlspecialchars($produto['descricao_produto']); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="preco_produto">Preço</label>
                        <input type="number" step="0.01" id="preco_produto" name="preco_produto" value="<?php echo htmlspecialchars($produto['preco_produto']); ?>" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="foto_produto">Foto do Produto</label>
                        <input type="file" id="foto_produto" name="foto_produto" class="form-control">
                        <small>Deixe em branco para não alterar a imagem.</small>
                    </div> 
                    <input type="hidden" name="foto_produto_antiga" value="<?php echo htmlspecialchars($produto['foto_produto']); ?>">
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                    <a href="<?php echo BASE_URL . 'produtos/listar'; ?>" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        <?php else: ?>
            <p>Produto não encontrado.</p>
        <?php endif; ?>


    </main>

    <footer>
        <?php
        // Inclui o cabeçalho
        require(__DIR__.'/../../template/footer.php');
      
        ?>
    </footer>


    </main>


    <?php
    // Inclui o script
    require(__DIR__.'/../../script_geral/script.php');
   
    ?>

</body>

</html>