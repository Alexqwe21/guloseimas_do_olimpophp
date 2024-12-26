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

        <section class="banner_produtos" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner_produto[0] ['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Encomende seu produto</h2>
                </div>
            </article>
        </section>

        <section class="produtos">
            <article class="site">
                <div class="lado_a_lado">

                    <div class="filtro-de-preco">
                        <ul>
                            <div>
                                <h4>Filtrar por preço</h4>
                            </div>
                            <div>
                                <input type="range" min="0" max="1000" value="250" class="escolher-valor" id="escolher-valor">
                                <p>Preço : R$ 0 - R$ 140</p>
                                <!-- <button><img src="img/filtrar.svg" alt="filtro"></button> -->
                                <h3>Filtrar por categoria</h3>

                                <div class="lado_a_lado_lista">
                                    <?php if (isset($categorias) && is_array($categorias)): ?>
                                        <?php foreach ($categorias as $categoria): ?>
                                            <li class="categoria-item" data-categoria="<?php echo htmlspecialchars($categoria['id_categoria'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <p><?php echo htmlspecialchars($categoria['nome_categoria'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li>
                                            <p>Nenhuma categoria disponível</p>
                                        </li>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <div class="produtos-container">
                        <div id="produtos">
                            <!-- Os produtos irão aparecer aqui após clicar no filtro -->
                        </div>
                    </div>

                    <div class="wrap">

                        <?php foreach ($pg_produtos as $PG_produtos): ?>
                            <div class="tamanho_link">
                                <a href="<?php echo BASE_URL . 'produtos/detalhe/' . $PG_produtos['link_produto']; ?>"> <!-- Substituindo o link fixo -->
                                    <div class="produto_a_mostra">
                                        
                                        <img src="<?php echo BASE_URL . 'uploads/' . $PG_produtos['foto_produto']; ?>" alt="<?php echo htmlspecialchars($PG_produtos['alt_foto_produto']); ?>" class="pg_produto">
                                    </div>
                                    <div class="preco_produto">
                                        <h3><?php echo htmlspecialchars($PG_produtos['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                        <p>R$ <?php echo number_format($PG_produtos['preco_produto'], 2, ',', '.'); ?></p>
                                        <button><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/adicionar_favoritos.svg"
                                                alt="adicionar_favoritos"></button>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>


                    </div>
                </div>
            </article>
        </section>

        <section class="ver_mais">
            <article class="site">
                <div>
                    <button>
                        <h3>Ver mais produtos</h3>
                    </button>
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
    document.addEventListener("DOMContentLoaded", function() {
        const categoriaItems = document.querySelectorAll('.categoria-item');

        categoriaItems.forEach(function(item) {
            item.addEventListener('click', function() {
                const categoriaId = this.dataset.categoria; // Capturando o ID da categoria

                // Fazendo a requisição AJAX
                fetch(`produtos.php?categoria=${categoriaId}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('produtos').innerHTML = data;
                    })
                    .catch(error => console.error('Erro ao buscar os produtos:', error));
            });
        });
    });
</script>

</html>