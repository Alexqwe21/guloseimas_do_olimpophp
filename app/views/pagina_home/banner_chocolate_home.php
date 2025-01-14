<section class="banner_chocolate">
    <article class="site">
        <section class="carousel">
            <section class="site">
                <div class="title">
                    <h3>Faça sua encomenda</h3>
                </div>
                <div class="box_carousel">
                    <?php foreach ($produto as $produtos): ?>
                        <?php if ($produtos['status_pedido'] === 'Ativo'): ?> <!-- Verifica se o produto está ativo -->
                            <div><a href="http://localhost/guloseimas_do_olimpophp/public/info_produtos"><img src="<?php echo BASE_URL . 'uploads/' . $produtos['foto_produto']; ?>"
                                        alt="<?php echo htmlspecialchars($produtos['alt_foto_produto']); ?>"></a></div>
                            <div><a href="http://localhost/guloseimas_do_olimpophp/public/info_produtos"><img src="<?php echo BASE_URL . 'uploads/' . $produtos['foto_produto']; ?>"
                                        alt="<?php echo htmlspecialchars($produtos['alt_foto_produto']); ?>"></a></div>
                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>
            </section>
        </section>
    </article>
</section>