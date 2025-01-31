<?php

class ContatoController extends Controller
{



    private $contatos_emails;


    public function __construct(){
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel


        $this->contatos_emails = new Contato();
    }


    public function index(){




        $dados = array();


        $banner_contato = new Banner();

        $contato_banner = $banner_contato->getBanner_contato();


        $dados['nome'] = 'cheguei aqui ';
        $dados['banner'] = $contato_banner;



        $this->carregarViews('contato', $dados);
    }


    public function enviarEmail(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
            $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
            $msg = filter_input(INPUT_POST, 'ajudar', FILTER_SANITIZE_SPECIAL_CHARS);
            $msg = filter_input(INPUT_POST, 'ajudar', FILTER_SANITIZE_SPECIAL_CHARS);

            // Substituir novas linhas por um caractere de espaço ou outro marcador
            $msg = str_replace(array("\r", "\n"), ' ', $msg);
            $msg = str_replace('&#13;&#10;', "\n", $msg);


            if ($nome && $email && $tel && $msg) {


                //Instanciar o Model de Contato
                $contatoModel = new Contato();

                $salvar = $contatoModel->salvarEmail($assunto, $nome, $email, $tel, $msg);

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
                        $phpmail->setFrom(USER_EMAIL, 'Contato do site'); // E-mail do remetente
                        $phpmail->addAddress(USER_EMAIL, $assunto); // E-mail do destinatário (sistema)


                        $phpmail->CharSet = 'UTF-8';
                        $phpmail->Encoding = 'base64';

                        $phpmail->Subject = $assunto; // Assunto
                        $phpmail->msgHTML(" Nome:  $nome <br>
                                            E-Mail: $email <br>
                                            Telefone: $tel <br>
                                            Mensagem: $msg");
                        $phpmail->AltBody = "Nome: $nome\nE-Mail: $email\nTelefone: $tel\nMensagem: $msg";

                        $phpmail->send();

                        // Segundo e-mail (confirmação para o usuário)
                        $phpmail->clearAddresses(); // Limpar os destinatários anteriores
                        $phpmail->addAddress($email, $nome); // Destinatário (usuário)

                        $phpmail->Subject = 'Confirmação de Contato'; // Assunto do e-mail de confirmação
                        $phpmail->msgHTML("<p>Olá $nome,</p>
                                           <p>Obrigado por entrar em contato conosco! Recebemos sua mensagem com os seguintes detalhes:</p>
                                           <ul>
                                               <li><strong>Nome:</strong> $nome</li>
                                               <li><strong>E-mail:</strong> $email</li>
                                               <li><strong>Telefone:</strong> $tel</li>
                                               <li><strong>Mensagem:</strong> $msg</li>
                                           </ul>
                                           <p>Em breve nossa equipe entrará em contato para responder sua solicitação.</p>
                                           <p>Atenciosamente,</p>
                                           <p>Guloseimas do olimpo </p>");
                        $phpmail->AltBody = "Olá $nome,\n\nObrigado por entrar em contato conosco! Recebemos sua mensagem e em breve responderemos.";

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


    public function contato(){






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarEmails'] = $this->contatos_emails->emails_contatos();

        $dados['conteudo'] = 'dash/contato/contato';



        $this->carregarViews('dash/dashboard', $dados);
    }
}
