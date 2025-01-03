<?php

class info_produtosController extends Controller
{


    private $info_produtos;




    public function __construct()
    {
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel
        $this->info_produtos = new Produto();
    }





    public function index()
    {




        $dados = array();


        $dados['nome'] = 'cheguei aqui ';



        $this->carregarViews('info_produtos', $dados);
    }


    public function info_produtos($id = null)
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit;
        }
    
        $dados = array();
    
        if ($id) {
            // Busca o produto pelo ID, caso ele seja fornecido
            $dados['listarServico'] = $this->info_produtos->getTodosServicos($id);
        } else {
            // Busca todos os produtos caso o ID não seja fornecido
            $dados['listarServico'] = $this->info_produtos->getTodosServicos();
        }
    
        $dados['conteudo'] = 'dash/info_produtos/info_produtos';
    
        $this->carregarViews('dash/dashboard', $dados);
    }


    public function editarI($id)
    {
        // Verifica se o usuário está logado e tem permissão para editar
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }
    
        // Obtém os dados do produto para edição
        $info_produto = $this->info_produtos->getServicoPorId($id);
    
        if (!$info_produto) {
            // Se o produto não for encontrado, redireciona para a lista de produtos
            header('Location: ' . BASE_URL . 'produtos/home');
            exit();
        }
    
        // Prepara os dados para a view
        $dados = array();
        $dados['info_produto'] = $info_produto;
        $dados['titulo'] = 'Editar Produto - Ki Oficina';
    
        // Carrega a view de edição
        $this->carregarViews('dash/info_produtos/editarI', $dados);
    }



}
