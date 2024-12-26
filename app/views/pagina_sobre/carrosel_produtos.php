<section class="carrosel_produtos">
    <article class="site">
        <div>
            <h3>BOLOS</h3>
        </div>
        <section>

            <div class="produtos_carrosel">
            <?php foreach ($galeria_sobre as $sobre_galeria): ?>
                    <div>
                        <img src="<?php echo BASE_URL . 'uploads/' .  $sobre_galeria['foto_galeria']; ?>" alt="img">
                    </div>
                    <?php endforeach; ?>

            </div>
        </section>
    </article>
</section>