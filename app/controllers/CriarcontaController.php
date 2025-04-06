<?php

class CriarcontaController extends Controller
{
    public function index()
    {
        $dados = array();

        // Obter os estados do banco de dados
        $estadoModel = new Estado();
        $banner_criar_conta = new Banner();
        $criar_conta_banner = $banner_criar_conta->getBanner_criar_conta();
        $Estado = $estadoModel->getEstado();
        $dados['banner'] =   $criar_conta_banner;
        $dados['Estado'] = $Estado;

        // Carregar a view com os estados
        $this->carregarViews('criarconta', $dados);
    }

    public function salvar()
    {
        // Inicia a sessão, caso ainda não esteja iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura e limpa os dados enviados pelo formulário
            $nome = strip_tags(trim(filter_input(INPUT_POST, 'nome')));
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $cpf = strip_tags(trim(filter_input(INPUT_POST, 'cpf')));
            $data_nasc = strip_tags(trim(filter_input(INPUT_POST, 'data_nascimento')));
            $telefone = strip_tags(trim(filter_input(INPUT_POST, 'telefone')));
            $endereco = strip_tags(trim(filter_input(INPUT_POST, 'endereco')));
            $bairro = strip_tags(trim(filter_input(INPUT_POST, 'bairro')));
            $cidade = strip_tags(trim(filter_input(INPUT_POST, 'cidade')));
            $estado = strtoupper(strip_tags(trim(filter_input(INPUT_POST, 'estado'))));
            $senha = strip_tags(trim(filter_input(INPUT_POST, 'senha')));
            $confirmar_senha = strip_tags(trim(filter_input(INPUT_POST, 'confirmar_senha')));
            $cep = strip_tags(trim(filter_input(INPUT_POST, 'cep')));


            // Validação dos dados
            if ($nome && $email && $cpf && $data_nasc && $telefone && $endereco && $bairro && $cidade && $estado && $senha) {
                if ($senha === $confirmar_senha) {
                    // Inserir no banco de dados
                    $clienteModel = new Cliente();
                    $resultado = $clienteModel->salvarCliente($nome, $email, $cpf, $data_nasc, $telefone, $endereco, $bairro, $cidade, $estado, $senha, $cep);
                    
                    if ($resultado) {
                        // Armazenando o email na sessão para ser usado na página de login
                        $_SESSION['emailTemp'] = $email;

                        // Mensagem de sucesso após criar conta
                        $_SESSION['sucesso'] = "Conta criada com sucesso!";
                        header('Location: ' . BASE_URL . 'entrar'); // Redireciona para a página de entrar
                        exit;
                    } else {
                        $_SESSION['erro'] = "Erro ao criar conta. Verifique os dados.";
                    }
                } else {
                    $_SESSION['erro_senha'] = "As senhas não coincidem!";
                    header('Location: ' . BASE_URL . 'criarconta'); // Redireciona de volta para a criação de conta
                    exit;
                }
            } else {
                $_SESSION['erro'] = "Preencha todos os campos!";
                header('Location: ' . BASE_URL . 'criarconta'); // Redireciona de volta para a criação de conta
                exit;
            }

            // Redirecionar em caso de erro
            header('Location: ' . BASE_URL . 'criarconta');
            exit;
        }
    }
}
