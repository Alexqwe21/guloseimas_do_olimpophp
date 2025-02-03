<?php
require_once("vendors/phpmailer/PHPMailer.php");
require_once("vendors/phpmailer/SMTP.php");
require_once("vendors/phpmailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RecuperarsenhaController extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Cliente();
    }

    public function index()
    {
        $dados = ['mensagem' => ''];
        $this->carregarViews('recuperar_senha', $dados);
    }

    public function enviarEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            
            // Verifica se o e-mail é válido
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mensagem = "Por favor, insira um e-mail válido.";
            } else {
                $usuario = $this->usuarioModel->buscarPorEmail($email);

                if ($usuario) {
                    // Gera uma nova senha temporária
                    $novaSenha = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                    $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

                    // Atualiza a senha no banco
                    if ($this->usuarioModel->atualizarSenha($email, $senhaCriptografada)) {
                        // Usando PHPMailer para enviar o e-mail com a nova senha
                        $mail = new PHPMailer(true);
                        try {
                            // Configurações do servidor SMTP
                            $mail->isSMTP();
                            $mail->Host = HOTS_EMAIL;  // Servidor SMTP
                            $mail->SMTPAuth = true;
                            $mail->Username = USER_EMAIL; // Seu e-mail
                            $mail->Password = PASS_EMAIL; // Sua senha do e-mail
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587; // Porta correta para TLS

                            // Remetente e destinatário
                            $mail->setFrom(USER_EMAIL, 'Sistema de Recuperação de Senha');
                            $mail->addAddress($email);

                            // Conteúdo do e-mail
                            $mail->isHTML(true);
                            $mail->Subject = 'Recuperação de Senha';
                            $mail->Body    = "Olá, <br><br> Sua nova senha foi gerada com sucesso!<br><strong>Senha temporária:</strong> $novaSenha<br><br>Troque-a assim que possível para garantir a segurança da sua conta.";

                            // Envia o e-mail
                            $mail->send();
                            $mensagem = "A nova senha foi enviada para seu e-mail com sucesso. Verifique sua caixa de entrada!";
                        } catch (Exception $e) {
                            $mensagem = "Houve um erro ao enviar o e-mail. Por favor, tente novamente mais tarde.";
                        }
                    } else {
                        $mensagem = "Ocorreu um erro ao atualizar a senha. Por favor, tente novamente.";
                    }
                } else {
                    $mensagem = "E-mail não encontrado em nosso sistema. Verifique se o e-mail está correto ou se você ainda não possui um cadastro.";
                }
            }

            // Retorna a mensagem para a view
            $dados = ['mensagem' => $mensagem];
            $this->carregarViews('recuperar_senha', $dados);
        }
    }
}
