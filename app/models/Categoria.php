<?php



class Categoria extends Model
{

    public function getCategoria()
    {



        $sql = "SELECT * FROM tbl_categoria WHERE status_categoria = 'Ativo'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Debug para verificar os dados retornados
  

    return $resultado;
    }


   
}

