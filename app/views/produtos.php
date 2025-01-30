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

        <section class="banner_produtos" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner_produto[0]['foto_banner']; ?>');">
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

                    <div class="wrap" id="produtos"> <!-- Aqui é o contêiner onde os produtos aparecerão -->
                        <?php foreach ($pg_produtos as $PG_produtos): ?>
                            <?php if ($PG_produtos['status_pedido'] === 'Ativo'): ?> <!-- Verifica se o produto está ativo -->
                                <div class="tamanho_link">
                                    <a href="<?php echo BASE_URL . 'produtos/detalhe/' . $PG_produtos['link_produto']; ?>">
                                        <div class="produto_a_mostra">
                                            <img src="<?php echo BASE_URL . 'uploads/' . $PG_produtos['foto_produto']; ?>"
                                                alt="<?php echo htmlspecialchars($PG_produtos['alt_foto_produto'], ENT_QUOTES, 'UTF-8'); ?>"
                                                class="pg_produto">
                                        </div>
                                        <div class="preco_produto">
                                            <h3><?php echo htmlspecialchars($PG_produtos['nome_produto'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                            <p>R$ <?php echo number_format($PG_produtos['preco_produto'], 2, ',', '.'); ?></p>
                                            <button>
                                                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/adicionar_favoritos.svg"
                                                    alt="adicionar_favoritos">
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div> <!-- Fecha o wrap -->
                </div>
            </article>
        </section>

        <section class="ver_mais">
            <article class="site">
                <div>
                    <button id="verMaisBtn">
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

    <!-- Modal de "Todos os produtos carregados" -->
    <div class="modal fade" id="modal_produtos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Status Produtos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Todos os produtos foram carregados! <!-- Aqui pode ajustar o texto conforme o caso -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let offset = 4; // Começa carregando 6 produtos
        const limite = 4; // Quantidade de produtos por requisição
        const btnVerMais = document.getElementById("verMaisBtn");
        const produtosContainer = document.getElementById("produtos");

        btnVerMais.addEventListener("click", function() {
            fetch(`<?php echo BASE_URL; ?>produtos/carregarMaisProdutos?offset=${offset}`)
                .then(response => response.text())
                .then(data => {
                    // Se o retorno estiver vazio, significa que não há mais produtos
                    if (data.trim() === "") {
                        // Oculta o botão "Ver mais" se não houver mais produtos
                        btnVerMais.style.display = "none";

                        // Exibe o modal informando que todos os produtos foram carregados
                        const modal = new bootstrap.Modal(document.getElementById('modal_produtos'));
                        modal.show();
                    } else {
                        // Adiciona os novos produtos carregados
                        produtosContainer.innerHTML += data;
                        offset += limite; // Atualiza o offset para carregar os próximos produtos
                    }
                })
                .catch(error => console.error("Erro ao carregar mais produtos:", error));
        });
    });
</script>

</html>