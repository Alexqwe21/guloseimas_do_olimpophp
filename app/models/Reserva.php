<?php



class Reserva extends Model
{

    public function listarReservasPorCliente($id_cliente)
    {



        $sql = "SELECT r.*, p.nome_produto, p.foto_produto 
        FROM tbl_reserva r 
        JOIN tbl_produtos p ON r.id_produto = p.id_produto 
        WHERE r.id_cliente = :id_cliente 
        ORDER BY r.data_entrega_reserva DESC";


        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function finalizarReserva()
    {
        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
            // Calcula o total da reserva
            $total = array_sum(array_map(function ($produto) {
                return $produto['quantidade'] * $produto['preco'];
            }, $_SESSION['carrinho']));
    
            $dataReserva = date('Y-m-d H:i:s'); // Data atual para a reserva
    
            // Prepara a consulta SQL para inserir a reserva no banco
            $sql = "INSERT INTO tbl_reserva (id_cliente, valor_total, data_reserva) VALUES (:id_cliente, :valor_total, :data_reserva)";
            $stmt = $this->db->prepare($sql);
    
            // Parâmetros da consulta
            $stmt->bindParam(':id_cliente', $_SESSION['userId']);
            $stmt->bindParam(':valor_total', $total);
            $stmt->bindParam(':data_reserva', $dataReserva);
    
          
        } else {
            // Caso o carrinho esteja vazio
            $_SESSION['erro'] = 'Carrinho vazio. Não é possível realizar a reserva.';
            header("Location: " . BASE_URL . "compras");
            exit();
        }
    }
    

    
    


}
