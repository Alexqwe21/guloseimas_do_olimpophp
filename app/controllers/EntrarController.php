<?php

class EntrarController extends Controller
{
    public function index()
    {
        $dados = array();

        $banner_entrar = new Banner();

        $entrar_banner = $banner_entrar->getBanner_entrar();

        $dados['banner'] = $entrar_banner;
        // Carrega a view de login
        $this->carregarViews('entrar', $dados);
    }

    public function entrar()
    {
        // Inicia a sessão, se necessário
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Captura os dados do formulário
            $email = filter_input(INPUT_POST, 'email_entrar', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha_entrar');

            // Verifica se o email e a senha foram preenchidos corretamente
            if ($email && $senha) {

                // Primeiro, verifica no modelo de Funcionário
                $funcionarioModel = new Funcionario();
                $funcionario = $funcionarioModel->buscarFunc($email);

                if ($funcionario && $funcionario['senha_funcionario'] === $senha) {
                    // Configura as variáveis de sessão para funcionário
                    $_SESSION['userId'] = $funcionario['id_funcionario'];
                    $_SESSION['userTipo'] = 'Funcionario';
                    $_SESSION['userNome'] = $funcionario['nome_funcionario'];
                    $_SESSION['userFoto'] = $funcionario['foto_funcionario'] ?? 'funcionario/default.svg'; // Foto ou padrão
                    $_SESSION['userEndereco'] = $funcionario['endereco_funcionario'];

                    // Redireciona para o dashboard do funcionário
                    header('Location: ' . BASE_URL . 'dashboard');
                    exit;
                }

                // Caso não seja um funcionário, verifica no modelo de Cliente
                $clienteModel = new Cliente();
                $cliente = $clienteModel->buscarCliente($email);

                if ($cliente && $cliente['senha_cliente'] === $senha) {
                    // Configura as variáveis de sessão para cliente
                    $_SESSION['userId'] = $cliente['id_cliente'];
                    $_SESSION['userTipo'] = 'Cliente';
                    $_SESSION['userNome'] = $cliente['nome_cliente'];
                    $_SESSION['userFoto'] = $cliente['foto_cliente'] ?? 'cliente/default.svg'; // Foto ou padrão
                    $_SESSION['userEndereco'] = $cliente['endereco_cliente'];

                    // Redireciona para o painel ou página do cliente
                    header('Location: ' . BASE_URL . 'painel_cliente');
                    exit;
                }

                // Email ou senha incorretos
                $_SESSION['login-erro'] = 'Email ou senha incorretos.';
            } else {
                $_SESSION['login-erro'] = 'Preencha todos os campos.';
            }

            // Redireciona para a página de login em caso de erro
            header('Location: ' . BASE_URL . 'entrar');
            exit;
        }

        // Redireciona para a página de login caso não seja uma requisição POST
        header('Location: ' . BASE_URL . 'entrar');
        exit;
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
