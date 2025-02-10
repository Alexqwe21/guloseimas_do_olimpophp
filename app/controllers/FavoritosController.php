<?php

class FavoritosController extends Controller
{
    private $favoritosModel;

    public function __construct()
    {
        $this->favoritosModel = new Favoritos();
    }

    public function index()
{
    if (!isset($_SESSION['userEmail'])) {
        header('Location: ' . BASE_URL . 'login');
        exit;
    }

    $email = $_SESSION['userEmail'];
    $clienteModel = new Cliente();
    $cliente = $clienteModel->buscarCliente($email);

    if (!$cliente) {
        header('Location: ' . BASE_URL . 'login');
        exit;
    }

    $id_cliente = $cliente['id_cliente'];

    // 🔹 TESTE 1: Verificar ID do cliente
    echo "<h3>ID Cliente:</h3>";
    var_dump($id_cliente);

    // 🔹 TESTE 2: Chamar a função do modelo diretamente
    $favoritos = $this->favoritosModel->getFavoritosByCliente($id_cliente);
    
    // 🔹 TESTE 3: Mostrar os favoritos diretamente no navegador
    echo "<h3>Favoritos do Cliente:</h3>";
    echo "<pre>";
    var_dump($favoritos);
    echo "</pre>";

    exit; // 🔴 Parar a execução para analisar os dados
}

    
    

   
    public function adicionarFavorito()
    {
        if (!isset($_SESSION['user_id'])) { 
            echo json_encode(['sucesso' => false, 'erro' => 'Usuário não autenticado']);
            exit;
        }
    
        // Captura os dados recebidos
        $input = file_get_contents('php://input');
        $data = json_decode($input, true); // Converte para array associativo
    
        // Verifica se os dados foram recebidos corretamente
        if (!$data || !isset($data['id_produto'])) {
            echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos']);
            exit;
        }
    
        $id_produto = $data['id_produto'];
        $id_cliente = $_SESSION['user_id']; // Pegando ID do usuário logado
    
        // Tenta adicionar aos favoritos
        if ($this->favoritosModel->adicionarFavorito($id_cliente, $id_produto)) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao adicionar aos favoritos']);
        }
    }
    
    

    public function removerFavorito()
    {
        if (!isset($_SESSION['user_id'])) { // Verificar se o id_cliente está na sessão
            echo json_encode(['sucesso' => false, 'erro' => 'Usuário não autenticado']);
            exit;
        }
    
        // Captura os dados recebidos
        $input = file_get_contents('php://input');
        $data = json_decode($input, true); // Converte para array associativo
    
        if (!$data || !isset($data['id_produto'])) {
            echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos']);
            exit;
        }
    
        $id_produto = $data['id_produto'];
        $id_cliente = $_SESSION['user_id']; // Pega o ID do cliente da sessão
    
        if ($this->favoritosModel->removerFavorito($id_cliente, $id_produto)) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao remover dos favoritos.']);
        }
    }
    
    
}
