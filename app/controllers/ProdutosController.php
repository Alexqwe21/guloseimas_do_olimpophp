<?php

class ProdutosController extends Controller
{

    private $produtoModel;
    private $banner_produto;
    private $categoria_produto;

    public function __construct()
    {
        // Inicializa a sessão se ainda não estiver iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Cria uma instância do modelo Produto e atribui à propriedade $produtoModel
        $this->produtoModel = new Produto();
        $this->banner_produto = new Banner();
        $this->categoria_produto = new Categoria();
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

        if ($link === null) {
            header("Location: /guloseimas_do_olimpophp/public");
            exit;
        }

        $dados = array();
        $produtoModel = new Produto();
        $detalheServico = $produtoModel->getServicoPorlink($link);

        if (!$detalheServico) {
            header("Location: /guloseimas_do_olimpophp/public");
            exit;
        }

        $dados['detalheServico'] = $detalheServico;
        $this->carregarViews('info_produtos', $dados);
    }

    //###################################################

    // BACK-END - DASHBORAD

    //###################################################


  public function listar()
{
    // Verifica se o usuário tem permissão para acessar
    if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
        header('Location:' . BASE_URL);
        exit;
    }

    // Verifica se foi passado um filtro de status e busca
    $status = $_GET['status'] ?? ''; // Obtém o valor do parâmetro 'status' da URL
    $busca = $_GET['busca'] ?? '';   // Obtém o valor do parâmetro 'busca' da URL

    // Define os dados a serem passados para a view
    $dados = array();

    // Se um status foi selecionado, filtra os produtos com base no status
    if ($status) {
        // Se houver busca também, passa para o método do modelo
        if ($busca) {
            $dados['listarServico'] = $this->produtoModel->getProdutosPorStatusEBusca($status, $busca);
        } else {
            $dados['listarServico'] = $this->produtoModel->getProdutosPorStatus($status);
        }
    } else {
        // Caso contrário, obtém todos os produtos (considerando a busca)
        if ($busca) {
            $dados['listarServico'] = $this->produtoModel->getProdutosPorBusca($busca);
        } else {
            // Caso não tenha filtro, busca todos os produtos
            $dados['listarServico'] = $this->produtoModel->getPg_produtos();
        }
    }

    // Carrega a view com os dados
    $dados['conteudo'] = 'dash/produtos/listar';
    $this->carregarViews('dash/dashboard', $dados);
}

    


    public function adicionar()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location:' . BASE_URL);
            exit;
        }
    
        $categoria = new Categoria();
        $dados['Todascategorias'] = $categoria->getCategoria();
        $dados['conteudo'] = 'dash/produtos/adicionar';
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filtra os inputs corretamente
            $nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $preco_produto = str_replace(',', '.', filter_input(INPUT_POST, 'preco_produto', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
            $alt_foto_produto = filter_input(INPUT_POST, 'alt_foto_produto', FILTER_SANITIZE_SPECIAL_CHARS);
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_NUMBER_INT);
            $status_pedido = filter_input(INPUT_POST, 'status_pedido', FILTER_SANITIZE_SPECIAL_CHARS);
            $link_produto = filter_input(INPUT_POST, 'link_produto', FILTER_SANITIZE_URL);
            $nova_categoria = filter_input(INPUT_POST, 'nova_categoria', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Verificação de campos obrigatórios
            if (!$nome_produto || !$preco_produto) {
                die("Erro: Todos os campos obrigatórios devem ser preenchidos.");
            }
    
            // Cria nova categoria se necessário
            if (empty($id_categoria) && !empty($nova_categoria)) {
                $id_categoria = $this->produtoModel->obterOuCriarcategoria($nova_categoria);
            }
    
            // Gera link único
            $link_produto = $this->gerarLinkServico($nome_produto);
    
            // Dados do produto
            $dadosproduto = [
                'nome_produto'     => $nome_produto,
                'preco_produto'    => $preco_produto,
                'alt_foto_produto' => $alt_foto_produto,
                'id_categoria'     => $id_categoria,
                'status_pedido'    => $status_pedido,
                'link_produto'     => $link_produto,
            ];
    
            // Informações adicionais
            $informacoes_produto = [
                'descricao_info_produto'         => filter_input(INPUT_POST, 'descricao_info_produto', FILTER_SANITIZE_SPECIAL_CHARS),
                'personalizacao_info_produtos'   => filter_input(INPUT_POST, 'personalizacao_info_produto', FILTER_SANITIZE_SPECIAL_CHARS),
                'forma_pagamento_info_produto'   => filter_input(INPUT_POST, 'forma_pagamento_info_produto', FILTER_SANITIZE_SPECIAL_CHARS),
                'entrega_info_produtos'          => filter_input(INPUT_POST, 'entrega_info_produtos', FILTER_SANITIZE_SPECIAL_CHARS),
                'reserva_info_produtos'          => filter_input(INPUT_POST, 'reserva_info_produtos', FILTER_SANITIZE_SPECIAL_CHARS),
            ];
    
            // Faz o upload da imagem (real ou padrão)
            $arquivo = $this->uploadFoto($_FILES['foto_produto'] ?? []);
    
            if ($arquivo) {
                $id_produto = $this->produtoModel->addproduto($dadosproduto, $arquivo, $informacoes_produto);
            } else {
                $_SESSION['mensagem'] = "Erro ao fazer o upload da imagem.";
                $_SESSION['tipo-msg'] = 'erro';
                header('Location: /produtos/adicionar/');
                exit;
            }
    
            if ($id_produto) {
                $_SESSION['mensagem'] = "Produto e suas informações adicionados com sucesso!";
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: /produtos/adicionar/');
                exit;
            } else {
                $dados['mensagem'] = "Erro ao adicionar o produto";
                $dados['tipo-msg'] = "erro-produto";
            }
        }
    
        $this->carregarViews('dash/dashboard', $dados);
    }
    

    private function uploadFoto($file)
    {
        $dir = __DIR__ . '/../../uploads/';
    
        if (!file_exists($dir . 'produto/')) {
            mkdir($dir . 'produto/', 0755, true);
        }
    
        // Se foi enviada uma imagem válida, faz o upload
        if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $nome_arquivo = 'produto/' . uniqid() . '.' . $ext;
    
            if (move_uploaded_file($file['tmp_name'], $dir . $nome_arquivo)) {
                return $nome_arquivo;
            }
        }
    
        // Retorna caminho da imagem padrão (já dentro da pasta uploads)
        return 'produto/selecione_a_foto.svg';
    }
    
    

    public function gerarLinkServico($nome_produto)
    {
        //REMOVE OS ACENTOS PARA CARACTERES EM CAIXAS BAIXAS 
        $semAcento = iconv('UTF-8', 'ASCII//TRANSLIT', $nome_produto);

        $link = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '-',  $semAcento)));



        $contador = 1;

        $link_original = $link;

        while ($this->produtoModel->existeEsseServico($link)) {


            $link = $link_original . '-' . $contador;
            $contador++;
        }



        return $link;
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
        $produto = $this->produtoModel->getProdutoPorId($id);

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
        $this->carregarViews('dash/produtos/status', $dados);
    }

    public function statusB($id)
    {
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Busca os dados do produto
        $banner = $this->banner_produto->getbannerPorId($id);

        if (!$banner) {
            $_SESSION['erro'] = "Produto não encontrado.";
            header('Location: ' . BASE_URL . 'produtos/banners');
            exit();
        }

        // Prepara os dados para a view
        $dados = [
            'banner' => $banner,
            'titulo' => 'Alterar Status do Produto'
        ];

        // Carrega a view do formulário
        $this->carregarViews('dash/banners/statusB', $dados);
    }

    public function statusC($id)
    {
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Busca os dados do produto
        $produto = $this->categoria_produto->getCategoriaPorId($id);

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
        $this->carregarViews('dash/categoria/statusC', $dados);
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

            // Verifica se uma nova imagem foi enviada
            if (!empty($_FILES['foto_produto']['name'])) {
                // Define o diretório de upload sem a pasta 'public'
                $diretorioUploads = __DIR__ . '/../../uploads/produto/';  // Caminho atualizado

                // Certifica-se de que o diretório existe
                if (!is_dir($diretorioUploads)) {
                    mkdir($diretorioUploads, 0755, true);  // Cria o diretório caso não exista
                }

                // Gera um nome único para a nova imagem
                $nomeArquivo = uniqid() . '_' . $_FILES['foto_produto']['name'];
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;

                // Move a imagem para o diretório
                if (move_uploaded_file($_FILES['foto_produto']['tmp_name'], $caminhoCompleto)) {
                    // Atualiza o caminho da imagem para salvar no banco
                    $novoCaminhoImagem = 'produto/' . $nomeArquivo;
                } else {
                    // Se ocorrer algum erro ao mover o arquivo
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header('Location: ' . BASE_URL . 'produtos/editar/' . $id);  // Redireciona para a página de edição
                    exit();
                }
            }

            // Aqui você deve atualizar o banco de dados com o novo caminho da imagem: $novoCaminhoImagem


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
                // Diretório de upload, sem a pasta 'public'
                $diretorioUploads = __DIR__ . '/../../uploads/banner/';

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

            // Código para atualizar o banco de dados com $novoCaminhoImagem

            // Atualiza os dados do produto
            $dados = [
                'nome_banner' => $_POST['nome_banner'],
                'foto_banner' => $novoCaminhoImagem,
                'alt_foto_banner' => $_POST['alt_foto_banner']
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

    public function atualizarStatus()
    {
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_produto'];
            $status = $_POST['status_pedido'];

            // Atualiza o status do produto
            if ($this->produtoModel->atualizarStatusProduto($id, $status)) {
                $_SESSION['mensagem'] = "Status atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'produtos/listar');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o status do produto.";
                header('Location: ' . BASE_URL . 'produtos/status/' . $id);
            }
            exit();
        }

        header('Location: ' . BASE_URL);
        exit();
    }

    public function atualizarStatusB()
    {
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_banner'];
            $status = $_POST['status_banner'];

            // Atualiza o status do produto
            if ($this->banner_produto->atualizarStatusBanner($id, $status)) {
                $_SESSION['mensagem'] = "Status atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'produtos/banner_produto');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o status do produto.";
                header('Location: ' . BASE_URL . 'produtos/banner_produto/' . $id);
            }
            exit();
        }

        header('Location: ' . BASE_URL);
        exit();
    }




    public function carregarMaisProdutos()
    {
        $limite = isset($_GET['limite']) ? intval($_GET['limite']) : 2; // Garantindo que o limite seja definido
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

        $produtos = $this->produtoModel->getVerMaisProdutos($limite, $offset);

        ob_start(); // Inicia o buffer de saída

        if (!empty($produtos)) {
            foreach ($produtos as $PG_produtos) {
                echo '<div class="tamanho_link">
                        <a href="/produtos/detalhe/' . htmlspecialchars($PG_produtos['link_produto']) . '" class="produtos_link_a">
                            <div class="produto_a_mostra">
                                <img src="/uploads/' . htmlspecialchars($PG_produtos['foto_produto']) . '" 
                                     alt="' . htmlspecialchars($PG_produtos['alt_foto_produto'], ENT_QUOTES, 'UTF-8') . '" 
                                     class="pg_produto">
                            </div>
                            <div class="preco_produto">
                                <h3>' . htmlspecialchars($PG_produtos['nome_produto'], ENT_QUOTES, 'UTF-8') . '</h3>
                                <p>R$ ' . number_format($PG_produtos['preco_produto'], 2, ',', '.') . '</p>
                                <button class="adicionar-favorito" data-id-produto="' . htmlspecialchars($PG_produtos['id_produto'], ENT_QUOTES, 'UTF-8') . '">
                                    <img src="/assets/img/adicionar_favoritos.svg" alt="Adicionar aos favoritos">
                                </button>
                            </div>
                        </a>
                    </div>';
            }
        } else {
            echo ""; // Se não houver mais produtos, retorna uma string vazia
        }

        ob_end_flush(); // Envia o buffer de saída
    }



    // Função para mostrar todos os produtos (sem filtro de categoria)
    public function mostrarTodosProdutos()
    {
        // Pega todos os produtos sem categoria filtrada
        $limite = isset($_GET['limite']) ? intval($_GET['limite']) : 2; // Padrão é 10
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

        // Recupera os produtos
        $produtos = $this->produtoModel->getTodosProdutos($limite, $offset);

        // Exibindo os produtos
        if (!empty($produtos)) {
            foreach ($produtos as $PG_produtos) {
                echo '<div class="tamanho_link">
                    <a href="/produtos/detalhe/' . htmlspecialchars($PG_produtos['link_produto']) . '" class="produtos_link_a">
                        <div class="produto_a_mostra">
                            <img src="/uploads/' . htmlspecialchars($PG_produtos['foto_produto']) . '" 
                                alt="' . htmlspecialchars($PG_produtos['alt_foto_produto'], ENT_QUOTES, 'UTF-8') . '" 
                                class="pg_produto">
                        </div>
                        <div class="preco_produto">
                            <h3>' . htmlspecialchars($PG_produtos['nome_produto'], ENT_QUOTES, 'UTF-8') . '</h3>
                            <p>R$ ' . number_format($PG_produtos['preco_produto'], 2, ',', '.') . '</p>
                             <button class="adicionar-favorito" data-id-produto="' . htmlspecialchars($PG_produtos['id_produto'], ENT_QUOTES, 'UTF-8') . '">
                                 <img src="/assets/img/adicionar_favoritos.svg" alt="Adicionar aos favoritos">
                            </button>
                        </div>
                    </a>    
                </div>';

                // Agora o script está fora do loop, sendo carregado uma vez por vez.
                echo '<script src="/public/assets/js/favoritos.js"></script>';
            }
        } else {
            echo '<p class="sem-produtos">Nenhum produto encontrado.</p>';
        }
    }


    public function filtrarPorPreco()
    {
        $precoMax = isset($_GET['preco']) ? floatval($_GET['preco']) : 100;

        // Buscar produtos até o preço máximo no banco de dados
        $produtos = $this->produtoModel->getProdutosPorPreco($precoMax);

        if (!empty($produtos)) {
            foreach ($produtos as $PG_produtos) {
                echo '<div class="tamanho_link">
                        <a href="/produtos/detalhe/' . htmlspecialchars($PG_produtos['link_produto']) . '">
                            <div class="produto_a_mostra">
                                <img src="/uploads/' . htmlspecialchars($PG_produtos['foto_produto']) . '" 
                                     alt="' . htmlspecialchars($PG_produtos['alt_foto_produto'], ENT_QUOTES, 'UTF-8') . '" 
                                     class="pg_produto">
                            </div>
                            <div class="preco_produto">
                                <h3>' . htmlspecialchars($PG_produtos['nome_produto'], ENT_QUOTES, 'UTF-8') . '</h3>
                                <p>R$ ' . number_format($PG_produtos['preco_produto'], 2, ',', '.') . '</p>
                                <button class="adicionar-favorito" data-id-produto="' . htmlspecialchars($PG_produtos['id_produto'], ENT_QUOTES, 'UTF-8') . '">
                                    <img src="/assets/img/adicionar_favoritos.svg" alt="Adicionar aos favoritos">
                                </button>
                            </div>
                        </a>    
                    </div>';
            }
        } else {
            echo '<p class="sem-produtos">Nenhum produto encontrado dentro desse preço.</p>';
        }
    }

    public function filtrarPorCategoria()
    {
        $categoriaId = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
        $limite = isset($_GET['limite']) ? intval($_GET['limite']) : 10;
        $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

        if ($categoriaId <= 0) {
            echo '<p class="sem-produtos">Categoria inválida.</p>';
            return;
        }

        // Recupera os produtos da categoria no Model
        $produtos = $this->produtoModel->getProdutosPorCategoria($categoriaId, $limite, $offset);

        if (!empty($produtos)) {
            foreach ($produtos as $PG_produtos) {
                echo '<div class="tamanho_link">
                    <a href="/produtos/detalhe/' . htmlspecialchars($PG_produtos['link_produto']) . '" class="produtos_link_a">
                        <div class="produto_a_mostra">
                            <img src="/uploads/' . htmlspecialchars($PG_produtos['foto_produto']) . '" 
                                 alt="' . htmlspecialchars($PG_produtos['alt_foto_produto'], ENT_QUOTES, 'UTF-8') . '" 
                                 class="pg_produto">
                        </div>
                        <div class="preco_produto">
                            <h3>' . htmlspecialchars($PG_produtos['nome_produto'], ENT_QUOTES, 'UTF-8') . '</h3>
                            <p>R$ ' . number_format($PG_produtos['preco_produto'], 2, ',', '.') . '</p>
                            <button class="adicionar-favorito" data-id-produto="' . htmlspecialchars($PG_produtos['id_produto'], ENT_QUOTES, 'UTF-8') . '">
                                <img src="/assets/img/adicionar_favoritos.svg" alt="Adicionar aos favoritos">
                            </button>
                        </div>
                    </a>
                </div>';
            }
        } else {
            echo '<p class="sem-produtos">Nenhum produto encontrado para esta categoria.</p>';
        }
    }




    public function listar_categoria()
    {
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: /');  // Caminho relativo
            exit;
        }

        $dados = array();
        $dados['listar_categoria'] = $this->categoria_produto->listar_getCategoria();
        $dados['conteudo'] = 'dash/categoria/listar_categoria';

        $this->carregarViews('dash/dashboard', $dados);
    }


    public function editarC($id)
    {
        // Verifica se o usuário está logado e tem permissão para editar
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        // Obtém os dados do produto para edição
        $categoria_produto = $this->categoria_produto->getCategoriaPorId($id);

        if (!$categoria_produto) {
            // Se o produto não for encontrado, redireciona para a lista de produtos
            header('Location: ' . BASE_URL . 'produtos/home');
            exit();
        }

        // Prepara os dados para a view
        $dados = array();
        $dados['categoria_produto'] = $categoria_produto;
        $dados['titulo'] = 'Editar Produto - Ki Oficina';

        // Carrega a view de edição
        $this->carregarViews('dash/categoria/editarC', $dados);
    }


    public function atualizarC()
    {
        // Verifica se o usuário tem permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_categoria'];

            // Captura os dados enviados pelo formulário
            $dados = [
                'nome_categoria' => $_POST['nome_categoria'], // Ajustado para o nome correto
                'descricao_categoria' => $_POST['descricao_categoria'] // Ajustado para a descrição correta
            ];

            // Chama o método de atualização no model
            if ($this->categoria_produto->atualizarCategoria($id, $dados)) {
                $_SESSION['mensagem'] = "Categoria atualizada com sucesso!";
                header('Location: ' . BASE_URL . 'dashboard');
            } else {
                $_SESSION['erro'] = "Erro ao atualizar a categoria.";
                header('Location: ' . BASE_URL . 'categorias/editarC/' . $id);
            }
            exit();
        }
    }


    public function atualizarStatusC()
    {
        // Verifica permissão
        if (!isset($_SESSION['userTipo']) || $_SESSION['userTipo'] !== 'Funcionario') {
            header('Location: ' . BASE_URL);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_categoria'] ?? null;
            $status = $_POST['status_categoria'] ?? null;

            // Verifica se os valores foram preenchidos
            if (empty($id) || empty($status)) {
                $_SESSION['erro'] = "ID ou Status inválido.";
                header('Location: ' . BASE_URL . 'categorias/listar');
                exit();
            }

            // Atualiza no banco
            if ($this->categoria_produto->atualizarStatusCategoria($id, $status)) {
                $_SESSION['mensagem'] = "Status atualizado com sucesso!";
            } else {
                $_SESSION['erro'] = "Erro ao atualizar o status da categoria.";
            }

            header('Location: ' . BASE_URL . 'produtos/listar_categoria');
            exit();
        }

        header('Location: ' . BASE_URL);
        exit();
    }
}
