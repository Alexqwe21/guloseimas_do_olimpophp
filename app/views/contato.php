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

        <section class="banner_contato" style="background-image: url('<?php echo BASE_URL . 'uploads/' . $banner[0] ['foto_banner']; ?>');">
            <article class="site">
                <div>
                    <h2>Contato</h2>
                </div>
            </article>
        </section>

        <section class="contato">
            <article class="site">
                <div class=" lado_a_lado">


                    <div class="detalhes_de_contato">
                        <h2>Detalhes de contato</h2>
                        <p>Rua 785 15h, Escritór Berlim, De 81566</p>
                        <p>info@email.com</p>
                        <p>+1 800 555 25 69</p>


                        <div class="redes_contato">
                            <a href="#" target="_blank"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/facebook_contato.svg" alt="img"></a>
                            <a href="#" target="_blank"> <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/twiter.svg" alt="img"></a>
                            <a href="#" target="_blank"> <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/instagram_contato.svg"
                                    alt="img"></a>
                        </div>

                    </div>

                    <div class="forms_contato">
                        <form action="" method="post">
                            <div class="nome">
                                <label for="nome"> <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/user_forms.svg" alt="user"></label>
                                <input type="tex" name="nome" id="nome" placeholder="NOME" required>

                                <div class="email">
                                    <label for="email"> <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/email_forms.svg"
                                            alt="telefone"></label>
                                    <input type="email" name="email" id="email" placeholder="EMAIL" required>
                                </div>

                            </div>

                            <div class="telefone">
                                <label for="tel"> <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/telefone_forms.svg"
                                        alt="telefone"></label>
                                <input type="tel" name="tel" id="tel" placeholder="TELEFONE" required>


                                <div class="assunto">
                                    <label for="assunto"> <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/assunto_forms.svg"
                                            alt="assunto"></label>
                                    <input type="text" name="assunto" id="assunto" placeholder="ASSUNTO" required>

                                </div>

                            </div>

                            <div class="textarea_forms">
                                <label for="ajudar"></label>
                                <div class="como_ajudar">
                                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/lapis_forms.svg" alt="lapis">
                                    <p>Como podemos ajudar voce ? Sinta-se a vontade para entrar em contato!</p>
                                </div>
                                <textarea name="ajudar" id="ajudar" cols="30" rows="10">

                           </textarea>

                            </div>


                            <div class="button_forms">

                                <button type="submit"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/enviar_froms.svg" alt="enviar">Entre
                                    em contato</button>
                            </div>

                        </form>


                    </div>
                </div>
            </article>
        </section>

        <section class="localizacao_contato">
            <article>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3659.025328309544!2d-46.43443702544899!3d-23.495597178845017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce63dda7be6fb9%3A0xa74e7d5a53104311!2sSenac%20S%C3%A3o%20Miguel%20Paulista!5e0!3m2!1spt-BR!2sbr!4v1732146448998!5m2!1spt-BR!2sbr"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>


            </article>
        </section>


        <!-- <section class="fotos_contato">
            <article class="site">

                <div class="produtos_contato">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">
                    <img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/Produto_contato.svg" alt="foto">




                    <div class="instagram_contato">
                        <a href="#"><img src="http://localhost/guloseimas_do_olimpophp/public/assets/img/instagram_contato_.svg" alt="instagram"></a>
                    </div>




                </div>
            </article>

        </section> -->



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