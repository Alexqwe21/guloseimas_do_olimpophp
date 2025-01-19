<style>
    .cliente_logado {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cliente_logado .foto_cliente {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .cliente_logado p {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: black;
    }

    .cliente_logado .logout {
        margin-left: 10px;
        color: #f00;
        text-decoration: none;
        font-size: 14px;
    }

    .cliente_logado .logout:hover {
        text-decoration: underline;
    }

    .login_header {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 15px;
    }
</style>

<div class="site">
    <div class="logo_header">
        <h1>
            <a href="http://localhost/guloseimas_do_olimpophp/public/home">
                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/logo_header.svg"
                    alt="Logo da Empresa - Guloseimas do Olimpo">
            </a>
        </h1>
    </div>

    <nav>
        <div class="mobile-menu">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>

        <ul class="nav-list">
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/home">HOME</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/sobre">SOBRE</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/produtos">PRODUTOS</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/compras">RESERVA</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/galeria">GALERIA</a></li>
            <li><a href="http://localhost/guloseimas_do_olimpophp/public/contato">CONTATO</a></li>
            <li class="close-btn"><a href="#">FECHAR</a></li>
        </ul>
    </nav>

    <div class="login_header">
        <?php if (isset($_SESSION['userId'])): ?>
            <div class="cliente_logado">
                <!-- Foto do cliente -->
                 <a href="http://localhost/guloseimas_do_olimpophp/public/painel_cliente">
                <img src="<?php echo BASE_URL . 'uploads/' . $_SESSION['userFoto']; ?>"
                    alt="Foto de <?php echo $_SESSION['userNome']; ?>" class="foto_cliente">
                    </a>
                <!-- Nome do cliente -->
                <p><?php echo $_SESSION['userNome']; ?>!</p>
                <!-- Botão de logout -->
                <a href="http://localhost/guloseimas_do_olimpophp/public/login/sair" class="logout">Sair</a>
            </div>
        <?php else: ?>
            <!-- Link para login se não estiver logado -->
            <a href="<?php echo BASE_URL; ?>login">
                <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/login.svg" alt="Login">
            </a>
        <?php endif; ?>
    </div>
</div>
