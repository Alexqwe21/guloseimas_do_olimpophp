<?php



class Destaque extends Model
{
    // Método para obter produtos destacados específicos
    public function getDestaque()
    {
        // IDs dos produtos que você deseja selecionar
        $idsDestaque = [108, 109, 110];

        // Preparar a consulta SQL com placeholders para os IDs
        $sql = "SELECT id_produto, foto_produto, alt_foto_produto, nome_produto, preco_produto, link_produto
                FROM tbl_produtos
                WHERE id_produto IN (" . implode(',', array_fill(0, count($idsDestaque), '?')) . ")";

        // Preparar a instrução SQL
        $stmt = $this->db->prepare($sql);

        // Vincular os valores dos IDs aos placeholders
        foreach ($idsDestaque as $index => $id) {
            $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
        }

        // Executar a consulta
        $stmt->execute();

        // Retornar os resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
