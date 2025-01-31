<?php

class NewsletterController extends Controller
{



    private $Newsletter;


    public function __construct(){
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel


        $this->Newsletter = new Newsletter();
    }


    public function index(){




        $dados = array();


        $banner_contato = new Banner();

        $contato_banner = $banner_contato->getBanner_contato();


        $dados['nome'] = 'cheguei aqui ';
        $dados['banner'] = $contato_banner;



        $this->carregarViews('contato', $dados);
    }


    public function enviarNewsletter(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $email = filter_input(INPUT_POST, 'email_newsletter', FILTER_SANITIZE_EMAIL);


            // Substituir novas linhas por um caractere de espaço ou outro marcador


            if ($email) {


                //Instanciar o Model de Contato
                $Newsletter = new Newsletter();

                $salvar = $Newsletter->salvarNewsletter($email);


                if ($salvar) {
                } else {
                    $dados = array(
                        'mensagem' => 'Esse email já está cadastrado!',
                        'status'   => 'erro'
                    );
                }


                if ($salvar) {

                    //reconhecer estrutura PHPMAILER
                    require_once("vendors/phpmailer/PHPMailer.php");
                    require_once("vendors/phpmailer/SMTP.php");
                    require_once("vendors/phpmailer/Exception.php");

                    $phpmail = new PHPMailer\PHPMailer\PHPMailer(); //Gerando variavel de email

                    try {
                        // Primeiro e-mail (para o sistema)
                        $phpmail->isSMTP(); // envio por SMTP
                        $phpmail->SMTPDebug = 0;

                        $phpmail->Host = HOTS_EMAIL; // Servidor SMTP
                        $phpmail->Port = PORT_EMAIL; // Porta do servidor SMTP
                        $phpmail->SMTPSecure = 'ssl'; // Certificado SSL
                        $phpmail->SMTPAuth = true; // Requer autenticação
                        $phpmail->Username = USER_EMAIL; // Usuário do SMTP
                        $phpmail->Password = PASS_EMAIL; // Senha do SMTP

                        $phpmail->IsHTML(true); // Trabalhar com estrutura HTML
                        $phpmail->setFrom(USER_EMAIL, 'Contato do Site - Goloseimas do Olimpo'); // E-mail do remetente
                        $phpmail->addAddress(USER_EMAIL, 'Goloseimas do Olimpo - Atendimento'); // E-mail do destinatário (sistema)

                        $phpmail->CharSet = 'UTF-8';
                        $phpmail->Encoding = 'base64';

                        $phpmail->Subject = 'Novo Contato Recebido - Goloseimas do Olimpo'; // Assunto
                        $phpmail->msgHTML("<p><strong>Olá,</strong></p>
                                           <p>Você recebeu um novo contato no site de Goloseimas do Olimpo. Aqui estão os detalhes:</p>
                                           <ul>
                                             
                                               <li><strong>E-mail:</strong> $email</li>
                                            
                                           </ul>
                                           <p>Por favor, entre em contato com o cliente o mais breve possível.</p>
                                           <p>Atenciosamente,</p>
                                           <p><strong>Equipe Goloseimas do Olimpo</strong></p>");
                        $phpmail->AltBody = "Novo Contato Recebido - Goloseimas do Olimpo\n\nDetalhes do Contato:\n\nNome: $nome\nE-mail: $email\nTelefone: $tel\nMensagem: $msg\n\nPor favor, entre em contato com o cliente o mais breve possível.";

                        $phpmail->send();
                        // Segundo e-mail (confirmação para o usuário)
                        $phpmail->clearAddresses(); // Limpar os destinatários anteriores
                        $phpmail->addAddress($email, $nome); // Destinatário (usuário)

                        $phpmail->Subject = 'Confirmação de Inscrição na nossa Newsletter'; // Assunto do e-mail de confirmação
                        $phpmail->msgHTML("<p>Olá</p>
                                           <p>Obrigado por se inscrever na nossa Newsletter! Estamos muito felizes em tê-lo conosco.</p>
                                           <p>A partir de agora, você receberá as últimas novidades, promoções exclusivas e conteúdos incríveis diretamente em seu e-mail.</p>
                                           <p><strong>Detalhes da sua inscrição:</strong></p>
                                           <ul>
                                               <li><strong>E-mail:</strong> $email</li>
                                           </ul>
                                           <p>Fique de olho na sua caixa de entrada, pois em breve enviaremos novidades fresquinhas para você.</p>
                                           <p>Se você tiver alguma dúvida ou precisar de algo, nossa equipe está sempre à disposição.</p>
                                           <p>Atenciosamente,</p>
                                           <p>Equipe Goloseimas do Olimpo</p>");
                        $phpmail->AltBody = "Olá $nome,\n\nObrigado por se inscrever na nossa Newsletter! Agora você receberá as últimas novidades e ofertas diretamente em seu e-mail.\n\nAtenciosamente,\nEquipe Goloseimas do Olimpo";

                        $phpmail->send();

                        $dados = array(
                            'mensagem' => 'Obrigado pelo seu contato, em breve responderemos',
                            'status'   => 'sucesso'



                        );

                        header('Location: ' . BASE_URL . 'home'); // Redireciona para a home
                        exit;


                        $this->carregarViews('contato', $dados);
                    } catch (Exception $e) {
                        $dados = array(
                            'mensagem' => 'Não foi possível enviar sua mensagem!',
                            'status'   => 'erro',
                            'erro'     => $phpmail->ErrorInfo
                        );

                        error_log('Erro ao enviar o email: ' . $phpmail->ErrorInfo);
                        $this->carregarViews('contato', $dados);
                    }
                }
            } // FIM DO IF que testa se os campos estão preenchidos

        } else {
            $dados = array();
            $this->carregarViews('contato', $dados);
        }
    }


    public function contato_Newsletter(){






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarEmails'] = $this->Newsletter->emails_Newsletter();

        $dados['conteudo'] = 'dash/newsletter/newsletter';



        $this->carregarViews('dash/dashboard', $dados);
    }
}
