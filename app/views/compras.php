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


    if (isset($_POST['esvaziar_carrinho'])) {
        unset($_SESSION['carrinho']); // Limpa o carrinho
        header("Location: " . BASE_URL . "compras"); // Atualiza a página
        exit;
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
                                    <h6>
                                        <!-- Formulário para remover um produto -->
                                        <form method="POST" action="<?php echo BASE_URL . 'compras/removerItemCarrinho'; ?>" style="display: inline;">
                                            <input type="hidden" name="idProduto" value="<?php echo $idProduto; ?>">
                                            <button type="submit" class="remove-button" style="border: none; background: none; color: red; cursor: pointer;">
                                                REMOVER <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
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
                                            <button class="decrement-button">-</button>
                                        </div>
                                        <div class="number">
                                            <p class="number-display" data-preco="<?php echo $produto['preco']; ?>">
                                                <?php echo $produto['quantidade']; ?>
                                            </p>
                                        </div>
                                        <div>
                                            <button class="increment-button">+</button>
                                        </div>
                                    </div>

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
                        <form method="POST" action="">
                            <button type="submit" name="esvaziar_carrinho" class="esvaziar-btn">Esvaziar Carrinho</button>
                        </form>
                        <div>
                            <a href="http://localhost/guloseimas_do_olimpophp/public/produtos">Continuar Comprando</a>
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

<script>
    document.querySelectorAll('.qtd_box').forEach(function(qtdBox) {
        // Botões de incremento e decremento
        const decrementButton = qtdBox.querySelector('.decrement-button');
        const incrementButton = qtdBox.querySelector('.increment-button');
        const numberDisplay = qtdBox.querySelector('.number-display');
        const subtotalDisplay = qtdBox.closest('.compras_box').querySelector('.subtotal h6');

        // Elementos de resumo de compras
        const totalDisplay = document.querySelector('.total_compras p:last-child'); // Exibe o total do resumo
        const resumoPedido = document.querySelector('.resumo_pedido h6'); // Exibe o total do pedido
        const numProdutosDisplay = document.querySelector('.resumo_pedido p'); // Exibe o número de produtos

        // Função para atualizar o resumo
        const atualizarResumo = () => {
            let total = 0;
            let numProdutos = 0;

            // Itera por cada produto para calcular o total atualizado
            document.querySelectorAll('.compras_box').forEach(function(box) {
                const quantidade = parseInt(box.querySelector('.number-display').textContent);
                const preco = parseFloat(box.querySelector('.number-display').dataset.preco);

                total += quantidade * preco; // Soma ao total
                numProdutos += quantidade; // Soma a quantidade
            });

            // Atualiza o total e o número de produtos no resumo
            totalDisplay.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
            resumoPedido.textContent = 'R$ ' + total.toFixed(2).replace('.', ',');
            numProdutosDisplay.textContent = numProdutos + ' Produto(s)';
        };

        // Adiciona evento de clique no botão de incremento
        incrementButton.addEventListener('click', function() {
            let quantidade = parseInt(numberDisplay.textContent); // Pega a quantidade atual
            const preco = parseFloat(numberDisplay.dataset.preco); // Pega o preço do atributo data-preco

            // Incrementa a quantidade
            quantidade++;
            numberDisplay.textContent = quantidade;

            // Atualiza o subtotal
            const subtotal = quantidade * preco;
            subtotalDisplay.textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');

            // Atualiza o resumo
            atualizarResumo();
        });

        // Adiciona evento de clique no botão de decremento
        decrementButton.addEventListener('click', function() {
            let quantidade = parseInt(numberDisplay.textContent); // Pega a quantidade atual
            const preco = parseFloat(numberDisplay.dataset.preco); // Pega o preço do atributo data-preco

            // Evita que a quantidade seja menor que 1
            if (quantidade > 1) {
                quantidade--;
                numberDisplay.textContent = quantidade;

                // Atualiza o subtotal
                const subtotal = quantidade * preco;
                subtotalDisplay.textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');

                // Atualiza o resumo
                atualizarResumo();
            }
        });
    });
</script>


</html>