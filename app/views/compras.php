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
        <section class="compras">
            <article class="site">
                <div>
                    <h3>Carinho de Compras</h3>
                </div>
                <div class="lado_a_lado">
                    <div class="compras_box">
                        <div>
                            <a href="#">
                                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/produto_a_mostra-01.svg"
                                    alt="Produto - Carrinho de Compras">
                            </a>
                        </div>
                        <div class="desc_compras">
                            <p>Chocolate Truffles</p>
                            <p>500g</p>
                            <h6>REMOVER
                                <i class="fa-solid fa-trash"></i>
                            </h6>
                        </div>
                        <div class="compras_preco">
                            <p>PREÇO UNITÁRIO</p>
                            <h6>R$9.99</h6>
                        </div>

                        <div class="qtd_compras">
                            <p>QUANTIDADE</p>
                            <div class="qtd_box">
                                <div>
                                    <button class="decrement-button" id="decrement-button">-</button>
                                </div>
                                <div class="number">
                                    <p id="number-display">1</p>
                                </div>
                                <div>
                                    <button class="increment-button" id="increment-button">+</button>
                                </div>
                            </div>
                            <p>12 Itens em estoque</p>
                        </div>

                        <div class="subtotal">
                            <p>Subtotal</p>
                            <h6>R$9.99</h6>
                        </div>

                    </div>

                    <div class="resumo_compras">
                        <h3>Resumo do pedido</h3>
                        <div class="resumo_pedido">
                            <p>1</p>
                            <p>Produto(s)</p>
                            <h6>R$9.99</h6>
                        </div>
                        <hr>
                        <div class="total_compras">
                            <p>TOTAL</p>
                            <p>R$9.99</p>
                        </div>

                        <div class="finalizar">
                            <div> </div>
                            <a href="#">Reservar Pedido</a>
                        </div>
                    </div>
                </div>

                <div class="acoes_compras">
                    <p>Esvaziar Carrinho</p>
                    <div>
                        <a href="produtos.html">Continuar Comprando</a>
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