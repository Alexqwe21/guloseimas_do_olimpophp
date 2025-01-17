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

    <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Verifica se há itens no carrinho
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])):
    $total = 0; // Inicializa o total fora do loop
?>

<main>
    <section class="compras">
        <article class="site">
            <div>
                <h3>Carrinho de Compras</h3>
            </div>
            <div class="lado_a_lado">

                <?php
                foreach ($_SESSION['carrinho'] as $idProduto => $produto):
                    $subtotal = $produto['quantidade'] * $produto['preco']; // Calcula o subtotal
                    $total += $subtotal; // Soma o subtotal ao total
                ?>

                    <div class="compras_box">
                        <div>
                            <a href="#">

                            <img src="<?php echo BASE_URL . 'uploads/' . $produto['foto']; ?>" alt="<?php echo $produto['nome']; ?>">


                           

                            </a>
                        </div>
                        <div class="desc_compras">
                            <p><?php echo $produto['nome']; ?></p>
                            <p>500g</p>
                            <h6>REMOVER
                                <i class="fa-solid fa-trash"></i>
                            </h6>
                        </div>
                        <div class="compras_preco">
                            <p>PREÇO UNITÁRIO</p>
                            <h6>R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></h6>
                        </div>

                        <div class="qtd_compras">
                            <p>QUANTIDADE</p>
                            <div class="qtd_box">
                                <div>
                                    <button class="decrement-button" id="decrement-button">-</button>
                                </div>
                                <div class="number">
                                    <p id="number-display"><?php echo $produto['quantidade']; ?></p>
                                </div>
                                <div>
                                    <button class="increment-button" id="increment-button">+</button>
                                </div>
                            </div>
                            <p>12 Itens em estoque</p>
                        </div>

                        <div class="subtotal">
                            <p>Subtotal</p>
                            <h6>R$<?php echo number_format($subtotal, 2, ',', '.'); ?></h6>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="resumo_compras">
                    <h3>Resumo do pedido</h3>
                    <div class="resumo_pedido">
                        <p><?php echo count($_SESSION['carrinho']); ?> Produto(s)</p>
                        <h6>R$<?php echo number_format($total, 2, ',', '.'); ?></h6>
                    </div>
                    <hr>
                    <div class="total_compras">
                        <p>TOTAL</p>
                        <p>R$<?php echo number_format($total, 2, ',', '.'); ?></p>
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

<?php
else:
    echo "Seu carrinho está vazio.";

    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        echo '<pre>';
        print_r($_SESSION['carrinho']); // Exibe o conteúdo do carrinho
        echo '</pre>';
    } else {
        echo 'Seu carrinho está vazio.';
    }

endif;
?>


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