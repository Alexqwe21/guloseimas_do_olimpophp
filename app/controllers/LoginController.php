<?php

class LoginController extends Controller
{
    public function index()
    {
        // Variável para armazenar os dados que serão passados para as views
        $dados = array();
        $banner_login = new Banner();
        $login_banner = $banner_login->getBanner_login();

        $dados['banner'] =  $login_banner;

        // Carrega a view de login
        $this->carregarViews('login', $dados);
    }

    public function login()
    {
        session_start();

        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura o email do formulário de login
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

            // Verifica se o email foi preenchido corretamente
            if ($email) {
                // Armazena o email na sessão antes de redirecionar para "entrar"
                $_SESSION['emailTemp'] = $email;

                // Verifica primeiro no modelo de Funcionário
                $funcionarioModel = new Funcionario($email);
                $funcionario = $funcionarioModel->buscarFunc($email);

                if ($funcionario) {
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userTipo'] = 'Funcionario';
                    $_SESSION['user_id'] = $funcionario['id_funcionario'];
                    header('Location: ' . BASE_URL . 'entrar');
                    exit;
                }

                $clienteModel = new Cliente();
                $cliente = $clienteModel->buscarCliente($email);

                if ($cliente) {
                    $_SESSION['userEmail'] = $email;
                    $_SESSION['userTipo'] = 'Cliente';
                    $_SESSION['user_id'] = $cliente['id_cliente'];
                    header('Location: ' . BASE_URL . 'entrar');
                    exit;
                }

                header('Location: /criarconta');
                exit;
            } else {
                $_SESSION['login-erro'] = 'Digite um email válido.';
            }

            header('Location: ' . BASE_URL);
            exit;
        }

        $this->carregarViews('login', $dados);
    }



    public function sair()
    {
        // Destrói a sessão para logout
        session_unset();
        session_destroy();

        // Redireciona para a página inicial após o logout
        header('Location: ' . BASE_URL);
        exit;
    }
}
