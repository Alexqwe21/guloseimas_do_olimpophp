<?php

class ProdutosController extends Controller
{

    private $produtoModel;
    private $banner_produto;

    public function __construct()
    {
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel
        $this->produtoModel = new Produto();
        $this->banner_produto = new Banner();
    }



    public function index()
    {
        $dados = array();

        $pg_produtos = new Produto();
        $categoriasModel = new Categoria();
        $banner_produto = new Banner();

        $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;

        // Buscar os dados necessários
        $Produto = $pg_produtos->getPg_produtos($categoria);
        $Categorias = $categoriasModel->getCategoria(); // Lista completa de categorias
        $banner_pr = $banner_produto->getBanner_produto();
        // Preparar dados para a view
        $dados['pg_produtos'] = $Produto;
        $dados['categorias'] = $Categorias; // Passando todas as categorias do banco para a view
        $dados['banner_produto'] = $banner_pr;

        // Carregar a view com os dados
        $this->carregarViews('produtos', $dados);
    }


    public function detalhe($link = null)
    {
        // var_dump("Método detalhe chamado");
        // var_dump($link);



        if ($link === null) {
            // Redireciona para a página inicial se o parâmetro estiver ausente
            header("Location: /guloseimas_do_olimpophp/public");
            exit;
        }

        $dados = array();

        $produtoModel = new Produto();

        // Chama o método corretamente para buscar os detalhes do produto
        $detalheServico = $produtoModel->getServicoPorlink($link);

        if (!$detalheServico) {
            // Redireciona se o produto não for encontrado
            header("Location: /guloseimas_do_olimpophp/public");
            exit;
        }

        // var_dump($detalheServico);

        $dados['detalheServico'] = $detalheServico;
        // $dados['info_produtos'] = $Produto;



        // Carregar a view de detalhes
        $this->carregarViews('info_produtos', $dados);
    }

    //###################################################

    // BACK-END - DASHBORAD

    //###################################################


    public function listar()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarServico'] = $this->produtoModel->getPg_produtos();

        $dados['conteudo'] = 'dash/servico/listar';



        $this->carregarViews('dash/dashboard', $dados);
    }


    public function banner_produto()
    {






        if (!isset($_SESSION['userTipo'])  || $_SESSION['userTipo'] !== 'Funcionario') {

            header('Location:' . BASE_URL);
            exit;
        }

        $dados = array();
        $dados['listarServico'] = $this->banner_produto->getBanner();

        $dados['conteudo'] = 'dash/banners/banners';



        $this->carregarViews('dash/dashboard', $dados);
    }

    public function editar($id)
    {
        // Verifica se o usuário está logado e tem permissão para editar
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }
    
        // Obtém os dados do produto para edição
        $produto = $this->produtoModel->getServicoPorlink($id);
    
        if (!$produto) {
            // Se o produto não for encontrado, redireciona para a lista de produtos
            header('Location: ' . BASE_URL . 'produtos/home');
            exit();
        }
    
        // Prepara os dados para a view
        $dados = array();
        $dados['produto'] = $produto;
        $dados['titulo'] = 'Editar Produto - Ki Oficina';
    
        // Carrega a view de edição
        $this->carregarViews('dash/servico/editar', $dados);
    }


    public function editarB($id)
    {
        // Verifica se o usuário está logado e tem permissão para editar
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }
    
        // Obtém os dados do produto para edição
        $banner_produto = $this->banner_produto->getbannerPorId($id);
    
        if (!$banner_produto) {
            // Se o produto não for encontrado, redireciona para a lista de produtos
            header('Location: ' . BASE_URL . 'produtos/home');
            exit();
        }
    
        // Prepara os dados para a view
        $dados = array();
        $dados['banner_produto'] = $banner_produto;
        $dados['titulo'] = 'Editar Produto - Ki Oficina';
    
        // Carrega a view de edição
        $this->carregarViews('dash/banners/editarB', $dados);
    }

    public function atualizar()
    {
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_produto'];
    
            // Verifica se uma nova imagem foi enviada
            $novoCaminhoImagem = $_POST['foto_produto_antiga']; // Caminho antigo por padrão
            if (!empty($_FILES['foto_produto']['name'])) {
                // Diretório de upload
                $diretorioUploads = __DIR__ . '/../../public/uploads/produto/';
    
                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }
    
                // Gera um nome único para a imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_produto']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;
    
                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_produto']['tmp_name'], $caminhoCompleto)) {
                    // Atualiza o caminho da imagem para salvar no banco
                    $novoCaminhoImagem = 'produto/' . $nomeArquivo;
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'produtos/editar/' . $id);
                    exit();
                }
            }
    
            // Atualiza os dados do produto
            $dados = [
                'nome_produto' => $_POST['nome_produto'],
                'descricao_produto' => $_POST['descricao_produto'],
                'preco_produto' => $_POST['preco_produto'],
                'foto_produto' => $novoCaminhoImagem
            ];
    
            if ($this->produtoModel->atualizarProduto($id, $dados)) {
                $_SESSION['mensagem'] = "Produto atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'dashboard');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o produto.";
                header('Location: ' . BASE_URL . 'produtos/editar/' . $id);
            }
            exit();
        }
    }



    public function atualizarBanner_produto()
    {
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_banner'];
    
            // Verifica se uma nova imagem foi enviada
            $novoCaminhoImagem = $_POST['foto_produto_antiga']; // Caminho antigo por padrão
            if (!empty($_FILES['foto_banner']['name'])) {
                // Diretório de upload
                $diretorioUploads = __DIR__ . '/../../public/uploads/banner/';
    
                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);
                }
    
                // Gera um nome único para a imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_banner']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;
    
                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_banner']['tmp_name'], $caminhoCompleto)) {
                    // Atualiza o caminho da imagem para salvar no banco
                    $novoCaminhoImagem = 'banner/' . $nomeArquivo;
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'produtos/editarB/' . $id);
                    exit();
                }
            }
    
            // Atualiza os dados do produto
            $dados = [
                'nome_banner' => $_POST['nome_banner'],
                'foto_banner' => $novoCaminhoImagem,
                'alt_foto_banner'=> $_POST['alt_foto_banner']
            ];
    
            if ($this->banner_produto->atualizarProduto_banner($id, $dados)) {
                $_SESSION['mensagem'] = "Banner atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'dashboard');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o produto.";
                header('Location: ' . BASE_URL . 'produtos/editarB/' . $id);
            }
            exit();
        }
    }


    public function status($id)
{
    // Verifica se o usuário tem permissão
    if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
        header('Location: ' . BASE_URL);
        exit();
    }

    // Busca os dados do produto
    $produto = $this->produtoModel->getProdutoPorId($id);

    if (!$produto) {
        $_SESSION['erro'] = "Produto não encontrado.";
        header('Location: ' . BASE_URL . 'produtos/listar');
        exit();
    }

    // Prepara os dados para a view
    $dados = [
        'produto' => $produto,
        'titulo' => 'Alterar Status do Produto'
    ];

    // Carrega a view do formulário
    $this->carregarViews('produtos/status', $dados);
}

    
    
    


}
