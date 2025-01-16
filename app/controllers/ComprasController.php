<?php

class ComprasController extends Controller{



public function index(){




$dados = array();


$dados['nome'] = 'cheguei aqui ';



$this->carregarViews('compras', $dados);
}



public function adicionarCarrinho($idProduto, $quantidade)
{
    var_dump('Método chamado com: ', $idProduto, $quantidade); // Verifica os parâmetros recebidos

    // Verifica se a sessão de carrinho já existe
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verifica se o produto já foi adicionado ao carrinho
    if (isset($_SESSION['carrinho'][$idProduto])) {
        // Se já estiver no carrinho, aumenta a quantidade
        $_SESSION['carrinho'][$idProduto]['quantidade'] += $quantidade;
    } else {
        // Caso contrário, adiciona o produto com a quantidade especificada
        $_SESSION['carrinho'][$idProduto] = [
            'quantidade' => $quantidade,
            'nome' => 'Nome do Produto', // Aqui você pode buscar o nome do produto no banco
            'preco' => 9.99 // O preço pode ser buscado com base no ID do produto
        ];
    }

    var_dump('Carrinho atualizado:', $_SESSION['carrinho']); // Inspeciona o estado do carrinho

    // Redireciona para a página do carrinho
    header('Location: ' . BASE_URL . 'carrinho');
    exit();
}





}