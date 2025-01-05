<?php



class Produto extends Model
{



    // METODO PARA PEGAR FOTOS DA GALERIA

    public function getProduto()
    {



        $sql = "SELECT id_produto,foto_produto, alt_foto_produto, nome_produto, preco_produto 
FROM tbl_produtos 
WHERE status_pedido = 'Ativo' LIMIT 10";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPg_produtos($categoria = null)
    {
        $sql = "SELECT * 
                FROM tbl_produtos p
                INNER JOIN tbl_categoria c ON c.id_categoria = p.id_categoria
                WHERE p.id_produto NOT IN (1, 2, 3, 4, 5, 6) 
                  AND p.status_pedido = 'Ativo'";

        // Adiciona a condição de categoria, se houver
        if ($categoria !== null) {
            $sql .= " AND c.nome_categoria = :categoria";
        }

        $stmt = $this->db->prepare($sql);

        // Liga o parâmetro da categoria, se necessário
        if ($categoria !== null) {
            $stmt->bindValue(':categoria', $categoria, PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getServicoPorlink($link)
    {
        $sql = "SELECT * 
FROM tbl_info_produtos AS ip
INNER JOIN tbl_produtos AS p ON ip.id_produto = p.id_produto WHERE status_info_produtos = 'Ativo' AND link_produto = :link";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':link', $link);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Certifique-se de que isso retorna um array ou um objeto
    }






    public function getTodosServicos($id = null)
{
    $sql = "SELECT * FROM tbl_info_produtos AS ip
            INNER JOIN tbl_produtos AS p ON ip.id_produto = p.id_produto";

    if ($id !== null) {
        $sql .= " WHERE ip.id_info_produtos = :id";
    }

    $stmt = $this->db->prepare($sql);

    if ($id !== null) {
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



public function getServicoPorId($id)
{
    $sql = "SELECT 
                ip.*, 
                p.* 
                 
            FROM tbl_info_produtos AS ip
            INNER JOIN tbl_produtos AS p ON ip.id_produto = p.id_produto
            WHERE ip.status_info_produtos = 'Ativo' AND ip.id_info_produtos = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    

    //###################################################

    // BACK-END - DASHBORAD

    //###################################################


    public function atualizarProduto($id, $dados)
{
    // Definindo a query SQL
    $sql = "UPDATE tbl_produtos 
            SET nome_produto = :nome_produto, 
                descricao_produto = :descricao_produto, 
                preco_produto = :preco_produto,
                foto_produto = :foto_produto
            WHERE id_produto = :id";
    
    // Depuração: Exibe a query e os dados antes da execução
    echo '<pre>';
    echo 'Query SQL antes da execução: ';
    var_dump($sql); // Exibe a query SQL
    echo 'Dados a serem vinculados: ';
    var_dump($dados); // Exibe os dados sendo passados para o banco
    echo '</pre>';
    
    // Prepara a query
    $stmt = $this->db->prepare($sql);
    
    // Vincula os parâmetros
    $stmt->bindValue(':nome_produto', $dados['nome_produto']);
    $stmt->bindValue(':descricao_produto', $dados['descricao_produto']);
    $stmt->bindValue(':preco_produto', $dados['preco_produto']);
    $stmt->bindValue(':foto_produto', $dados['foto_produto']);
    $stmt->bindValue(':id', $id);
    
    // Executa a query
    if (!$stmt->execute()) {
        echo '<pre>';
        echo 'Erro ao executar a query: ';
        print_r($stmt->errorInfo()); // Exibe os erros da execução
        echo '</pre>';
        return false;
    }
    return true;
}


public function atualizar_info_Produto($id, $dados)
{
    // Definindo a query SQL
    $sql = "UPDATE tbl_produtos AS p
    INNER JOIN tbl_info_produtos AS ip ON p.id_produto = ip.id_produto
    SET ip.nome_info_produtos = :nome_info_produtos,

        ip.descricao_info_produto = :descricao_info_produto,

        ip.foto_info_produto = :foto_info_produto,

        ip.info_alt_foto_produto = :info_alt_foto_produto,


        p.preco_produto = :preco_produto,

        ip.personalizacao_info_produtos = :personalizacao_info_produtos,

        ip.forma_pagamento_info_produto = :forma_pagamento_info_produto,

        ip.entrega_info_produtos = :entrega_info_produtos,

        ip.reserva_info_produtos = :reserva_info_produtos

    WHERE ip.id_info_produtos = :id";

    // // Depuração: Exibe a query e os dados antes da execução
    // echo '<pre>';
    // echo 'Query SQL antes da execução: ';
    // var_dump($sql); // Exibe a query SQL
    // echo 'Dados a serem vinculados: ';
    // var_dump($dados); // Exibe os dados sendo passados para o banco
    // echo '</pre>';
    
    // Prepara a query
    $stmt = $this->db->prepare($sql);
    
    // Vincula os parâmetros
    $stmt->bindValue(':nome_info_produtos', $dados['nome_info_produtos']);

    $stmt->bindValue(':descricao_info_produto', $dados['descricao_info_produto']);

    $stmt->bindValue(':foto_info_produto', $dados['foto_info_produto']);

    $stmt->bindValue(':info_alt_foto_produto', $dados['info_alt_foto_produto']);

    $stmt->bindValue(':preco_produto', $dados['preco_produto']);

    $stmt->bindValue(':personalizacao_info_produtos', $dados['personalizacao_info_produtos']);

    
    $stmt->bindValue(':forma_pagamento_info_produto', $dados['forma_pagamento_info_produto']);

    $stmt->bindValue(':entrega_info_produtos', $dados['entrega_info_produtos']);

    $stmt->bindValue(':reserva_info_produtos', $dados['reserva_info_produtos']);



    $stmt->bindValue(':id', $id);
    
    // Executa a query
    if (!$stmt->execute()) {
        echo '<pre>';
        echo 'Erro ao executar a query: ';
        print_r($stmt->errorInfo()); // Exibe os erros da execução
        echo '</pre>';
        return false;
    }
    return true;
}

public function getProdutoPorId($id)
{
    $sql = "SELECT * FROM tbl_produtos WHERE id_produto = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


public function atualizarStatusProduto($id, $status)
{
    $sql = "UPDATE tbl_produtos 
            SET status_pedido = :status 
            WHERE id_produto = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}





    
}
