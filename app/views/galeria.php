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

        <section class="banner_galeria">
            <article class="site">
                <div>
                    <h2>Galleria</h2>
                </div>
            </article>
        </section>

        <section class="fotos_galeria">
            <article class="site">

                <div class="lado_a_lado_galeria">
                    <?php foreach ($pg_galeria as $galeria_pg): ?>
                        <div class="galeria_pd">
                            <a href="#"><img src="<?php echo BASE_URL . 'uploads/' . $galeria_pg['foto_galeria']; ?>" alt="<?php echo htmlspecialchars($galeria_pg['alt_foto_galeria']); ?>" class="img_pg_galeria"></a>
                            <h3><?php echo htmlspecialchars($galeria_pg['nome_galeria'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        </div>




                    <?php endforeach; ?>
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