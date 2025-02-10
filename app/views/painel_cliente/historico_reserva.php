<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require(__DIR__ . '/../head_geral/head.php'); ?>
</head>

<body>

    <header>
        <?php require(__DIR__ . '/../template/header.php'); ?>
    </header>

    <main>
        <section>
            <article class="site">
                <div class="historico_pedido">
                    <h2>Histórico de Reservas</h2>
                    <p>Acompanhe os status dos seus pedidos</p>
                </div>

                <div class="card_title">
                    <?php if (!empty($reservas)) : ?>
                        <?php foreach ($reservas as $reserva) : ?>
                            <div class="card_informacoes">


                                <div class="colum">
                                    <span>Pedido</span>
                                    <span><?php echo $reserva['id_reserva']; ?></span>
                                </div>


                                <div class="colum">
                                    <span>Produto</span>
                                    <img src="<?php echo BASE_URL . 'uploads/' . $reserva['foto_produto']; ?>" alt="<?php echo htmlspecialchars($reserva['nome_produto']); ?>">

                                </div>


                                <div class="colum">
                                    <span>Pedido feito em</span>
                                    <span><?php echo date('d/m/Y', strtotime($reserva['data_reserva'])); ?></span>
                                </div>

                                <!-- <div class="colum">
                                    <span>Pagamento</span>
                                </div> -->

                                <div class="colum">
                                    <span>Status</span>
                                    <span><?php echo htmlspecialchars($reserva['status_reserva']); ?></span>
                                </div>

                                <div class="card_total_pago">
                                    <div class="colum">
                                        <span>Total pago</span>
                                        <span>R$ <?php echo number_format($reserva['valor_total'], 2, ',', '.'); ?></span>
                                    </div>

                                </div>



                            </div>


                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Você ainda não tem reservas.</p>
                    <?php endif; ?>
                </div>



            </article>
        </section>
    </main>

    <footer>
        <?php require(__DIR__ . '/../template/footer.php'); ?>
    </footer>

    <?php require(__DIR__ . '/../script_geral/script.php'); ?>

</body>

</html>