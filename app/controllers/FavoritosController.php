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

    // Chama o método para obter os favoritos
    $favoritos = $this->favoritosModel->getFavoritosByCliente($id_cliente);


    
    // Passa os dados necessários para a view
    $dados = [
        'nome' => $cliente['nome_cliente'],
        'favoritos' => $favoritos,  // Passa os favoritos para a view
    ];

    // Carrega a view de painel do cliente
    $this->carregarViews('painel_cliente/painel_cliente', $dados);
}

    public function adicionarFavorito()
    {
        if (!isset($_SESSION['user_id'])) { // Verificar se o id_cliente está na sessão
            echo json_encode(['sucesso' => false, 'erro' => 'Usuário não autenticado']);
            exit;
        }
    
        // Pegando os dados da requisição
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data || !isset($data['id_produto'])) {
            echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos']);
            exit;
        }
    
        $id_produto = $data['id_produto'];
        $id_cliente = $_SESSION['user_id']; // Usando o id_cliente, que deve ser numérico
    
        if ($this->favoritosModel->adicionarFavorito($id_cliente, $id_produto)) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao adicionar aos favoritos']);
        }
    }
    
    

    public function removerFavorito($id_produto)
    {
        $id_cliente = $_SESSION['user_id']; // Supondo que você tenha o ID do cliente na sessão

        if ($this->favoritosModel->removerFavorito($id_cliente, $id_produto)) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao remover dos favoritos.']);
        }
    }
}
