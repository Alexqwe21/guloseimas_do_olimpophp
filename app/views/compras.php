<style>
    .carrinho-vazio {
        text-align: center;
        padding: 50px 20px;
        background-color: #f9f9f9;
        /* Fundo suave */
        border: 1px solid #ddd;
        /* Borda leve */
        border-radius: 5px;
        /* Bordas arredondadas */
        max-width: 600px;
        /* Largura máxima */
        margin: 0 auto;
    }

    .carrinho-vazio h3 {
        font-size: 24px;
        color: #333;
    }

    .carrinho-vazio p {
        font-size: 16px;
        color: #555;
    }

    .carrinho-vazio a {
        color: #0066cc;
        text-decoration: none;
    }

    .carrinho-vazio a:hover {
        text-decoration: underline;
    }

    .esvaziar-btn {
        border: none;
        background-color: transparent;
        margin-right: 50px;
    }
</style>

<?php if (isset($_POST['esvaziar_carrinho'])) {
    unset($_SESSION['carrinho']); // Limpa o carrinho
    header("Location: " . BASE_URL . "compras"); // Atualiza a página
    exit;
}

// Lógica para gerar o link do WhatsApp
if (isset($_POST['reservar_pedido']) && isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $numeroWhatsApp = '5511968812993'; // Número do WhatsApp no formato internacional
    $mensagem = "Olá, gostaria de reservar os seguintes produtos:\n\n";

    foreach ($_SESSION['carrinho'] as $produto) {
        $mensagem .= "- " . $produto['nome'] . ": " . $produto['quantidade'] . " x R$" . number_format($produto['preco'], 2, ',', '.') . "\n";
    }

    $total = array_sum(array_map(function ($produto) {
        return $produto['quantidade'] * $produto['preco'];
    }, $_SESSION['carrinho']));

    $mensagem .= "\nTotal: R$" . number_format($total, 2, ',', '.');
    $mensagemCodificada = urlencode($mensagem);

    // Gera o link do WhatsApp
    $linkWhatsApp = "https://wa.me/$numeroWhatsApp?text=$mensagemCodificada";

    // Redireciona para o WhatsApp
    header("Location: $linkWhatsApp");

    // Esvazia o carrinho após enviar para o WhatsApp
    unset($_SESSION['carrinho']);
    exit;
}

?>
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
                                <form method="POST" action="">
                                    <button type="submit" name="reservar_pedido" id="reservarPedido">Reservar Pedido</button>
                                </form>
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
    ?>

        <section class="compras">
            <article class="site">
                <div class="carrinho-vazio">
                    <h3>Seu carrinho está vazio</h3>
                    <p>Que tal dar uma olhada nos nossos <a href="<?php echo BASE_URL; ?>produtos">produtos?</a></p>
                </div>
            </article>
        </section>

    <?php
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
        const decrementButton = qtdBox.querySelector('.decrement-button');
        const incrementButton = qtdBox.querySelector('.increment-button');
        const numberDisplay = qtdBox.querySelector('.number-display');
        const subtotalDisplay = qtdBox.closest('.compras_box').querySelector('.subtotal h6');

        const totalDisplay = document.querySelector('.total_compras p:last-child');
        const resumoPedido = document.querySelector('.resumo_pedido h6');
        const numProdutosDisplay = document.querySelector('.resumo_pedido p');

        // Função para atualizar o resumo e a URL do WhatsApp
const atualizarResumoEUrlWhatsApp = () => {
    let total = 0; // Inicializa o total como 0
    let numProdutos = 0; // Inicializa o número total de produtos
    let mensagem = "Olá, gostaria de reservar os seguintes produtos:\n\n"; // Começa a mensagem

    // Itera sobre cada produto no carrinho
    document.querySelectorAll('.compras_box').forEach(function (box) {
        const quantidade = parseInt(box.querySelector('.number-display').textContent);
        const preco = parseFloat(box.querySelector('.number-display').dataset.preco);
        const produtoNome = box.querySelector('.desc_compras p').textContent;

        const subtotal = quantidade * preco;
        total += subtotal; // Adiciona o subtotal ao total
        numProdutos += quantidade; // Incrementa o número total de produtos

        // Atualiza a mensagem
        mensagem += `- ${produtoNome}: ${quantidade} x R$${preco.toFixed(2).replace('.', ',')}\n`;
    });

    // Adiciona o total ao final da mensagem
    mensagem += `\nTotal: R$${total.toFixed(2).replace('.', ',')}`;

    // Codifica a mensagem para a URL do WhatsApp
    const mensagemCodificada = encodeURIComponent(mensagem);

    // Atualiza o link do WhatsApp
    const numeroWhatsApp = '5511968812993'; // Número do WhatsApp
    const linkWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensagemCodificada}`;
    document.querySelector('.finalizar a').setAttribute('href', linkWhatsApp);

    // Atualiza os valores exibidos no resumo do pedido
    totalDisplay.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
    resumoPedido.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
    numProdutosDisplay.textContent = `${numProdutos} Produto(s)`;
};

        // Evento de incremento
        incrementButton.addEventListener('click', function() {
            let quantidade = parseInt(numberDisplay.textContent);
            const preco = parseFloat(numberDisplay.dataset.preco);

            quantidade++;
            numberDisplay.textContent = quantidade;

            const subtotal = quantidade * preco;
            subtotalDisplay.textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;

            atualizarResumoEUrlWhatsApp();
        });

        // Evento de decremento
        decrementButton.addEventListener('click', function() {
            let quantidade = parseInt(numberDisplay.textContent);
            const preco = parseFloat(numberDisplay.dataset.preco);

            if (quantidade > 1) {
                quantidade--;
                numberDisplay.textContent = quantidade;

                const subtotal = quantidade * preco;
                subtotalDisplay.textContent = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;

                atualizarResumoEUrlWhatsApp();
            }
        });
    });

    
</script>




</html>