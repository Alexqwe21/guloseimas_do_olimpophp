<!DOCTYPE html>
<html lang="pt-br">

<head>

    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>

</head>
<A></A>
<body>

    <header>
        <?php
        // Inclui o cabeçalho
        require('template/header.php');
        ?>
    </header>
    <div class="space">

    </div>
    <main>
        <section class="reserva_produto">
            <article class="site">
                <div class="lado_a_lado">
                    <div>
                        <a href="http://localhost/guloseimas_do_olimpophp/public/produtos"><img src="<?php echo BASE_URL . 'uploads/' . $detalheServico['foto_info_produto']; ?>" alt="<?php echo htmlspecialchars($detalheServico['info_alt_foto_produto']); ?>" class="img_info"></a>
                    </div>
                    <div class="inf_produto">
                        <div class="reserva_title">
                            <h3><?php echo htmlspecialchars($detalheServico['nome_info_produtos'], ENT_QUOTES, 'UTF-8'); ?></h3>

                            <div class="reserva_preco">
                                <p>R$ <?php echo number_format($detalheServico['preco_produto'], 2, ',', '.'); ?></p>
                            </div>
                        </div>

                        <div class="reseva_personalizao">
                            <div class="inf_txt">
                                <p>O valor é equivalente a <span class="pers">personalização</span> <?php echo htmlspecialchars($detalheServico['personalizacao_info_produtos'], ENT_QUOTES, 'UTF-8'); ?></p>

                            </div>
                            <!-- <div class="tipos_personalizacoes">
                                <button></button>
                                <button></button>
                                <button></button>
                            </div>
                        </div>

                        <div class="reserva_preco">
                            <p>R$35</p>
                            <p>Quantidade em estoque  <?php echo number_format($detalheServico['qtd_info_produto'], ); ?> </p>
                        </div> -->

                        <div class="reserva_acoes">
                            <!-- <div class="qtd_produto">
                                <div class="number">
                                    <p id="number-display">1</p>
                                </div>
                                <div class="arrows">
                                    <button id="increment-button"><i class="fa-solid fa-arrow-up"></i> </button>
                                    <button id="decrement-button"><i class="fa-solid fa-arrow-down"></i></button>
                                </div>
                            </div> -->
                            <div class="carrinho_produto">
                                <div class="car">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                                <div>
                                    <a href="<?php echo BASE_URL . 'info_produtos/adicionarReserva/' . $detalheServico['id_produto']; ?>">
                                        <p>RESERVE AGORA</p>
                                    </a>
                                </div>
                            </div>
                            <div class="fav_produto">
                                <div>
                                    <i id="heart-icon" class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                        </div>

                        <div class="inf_txt">
                            <p>Todas as reservas são feitas excluisavamente pelo</p>
                            <p class="wtz">WHATSAPP</p>
                        </div>
                        <div class="space">

                        </div>
                    </div>
                </div>
            </article>
        </section>

        <section class="descricao_produto">
            <article class="site">
                <div class="desc">
                    <h3>DESCRIÇÃO</h3>
                    <p><?php echo htmlspecialchars($detalheServico['descricao_info_produto'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

                </div>
                <div class="desc">
                    <h3>FORMAS DE PAGAMENTO</h3>
                    <p><?php echo htmlspecialchars($detalheServico['forma_pagamento_info_produto'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

                </div>
                <div class="desc">
                    <h3>ENTREGA</h3>
                    <p><?php echo htmlspecialchars($detalheServico['entrega_info_produtos'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

                </div>
                <div class="desc">
                    <h3>RESERVAS</h3>
                    <p>Realizamos nossas reservas excluisavamente pelo <span class="pers">Whatsapp</span></p>
                    <p><?php echo htmlspecialchars($detalheServico['reserva_info_produtos'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <hr>

                </div>
                <div class="space">

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