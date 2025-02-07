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
        echo "<pre>Index do FavoritosController foi chamado</pre>";
    
        $dados = array(); // Inicializando o array para evitar erros
    
        if (!isset($_SESSION['userEmail'])) {
            echo "<pre>Usuário não autenticado</pre>";
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    
        $email = $_SESSION['userEmail'];
        $clienteModel = new Cliente();
        $cliente = $clienteModel->buscarCliente($email);
    
        if (!$cliente) {
            echo "<pre>Cliente não encontrado</pre>";
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    
        $id_cliente = $cliente['id_cliente'];
    
        echo "<pre>ID do cliente: " . $id_cliente . "</pre>";
    
        // Chama o método para obter os favoritos
        $favoritos = $this->favoritosModel->getFavoritosByCliente($id_cliente);
    
        echo "<pre>Favoritos encontrados:</pre>";
        var_dump($favoritos); // Verifica se há favoritos sendo retornados
    
        // Passa os dados necessários para a view
        $dados['favoritos_cliente'] = $favoritos;
    
        // Carrega a view de painel do cliente
        $this->carregarViews('painel_cliente/painel_cliente', $dados);
    }
    <A></A>
    

   
    public function adicionarFavorito()
    {
        if (!isset($_SESSION['user_id'])) { 
            echo json_encode(['sucesso' => false, 'erro' => 'Usuário não autenticado']);
            exit;
        }
    
        // Captura os dados recebidos
        $input = file_get_contents('php://input');
        echo "<pre>Dados Recebidos:</pre>";
        var_dump($input); // Verifica se os dados estão chegando
        exit;
    
        $data = json_decode($input, true);
        if (!$data || !isset($data['id_produto'])) {
            echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos']);
            exit;
        }
    }
    

    public function removerFavorito($id_produto)
    {
        if (!isset($_SESSION['user_id'])) { // Verificar se o id_cliente está na sessão
            echo json_encode(['sucesso' => false, 'erro' => 'Usuário não autenticado']);
            exit;
        }

        $id_cliente = $_SESSION['user_id']; // Supondo que você tenha o ID do cliente na sessão

        if ($this->favoritosModel->removerFavorito($id_cliente, $id_produto)) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao remover dos favoritos.']);
        }
    }
}
