<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    // Inclui o head
    require('head_geral/head.php');
    ?>
</head>
<!-- teste --> <!-- teste -->
<body>

    <header>
        <?php
        // Inclui o cabeçalho
        require('template/header.php');
        ?>
    </header>
    <main>
    <?php
        // loader
        require('template/loader.php');
        
        // Inclui  a pagina ben_vindo
        require('pagina_home/ben_vindo.php');


        // Inclui  a pagina destaque_home.php
        require('pagina_home/destaque_home.php');


        // Inclui  a pagina qualidade_especial_home
        require('pagina_home/qualidade_especial_home.php');

        // Inclui  a pagina sobre_pessoa_home.php
        require('pagina_home/sobre_pessoa_home.php');


        // Inclui  a pagina banner_chocolate_home.php
        require('pagina_home/banner_chocolate_home.php');

        ?>


        <footer>
            <?php
            // Inclui o cabeçalho
            require('template/footer.php');
            ?>

        </footer>

    </main>


    <?php
    // Inclui o script
    require('script_geral/script.php');
    ?>


</body>

</html>