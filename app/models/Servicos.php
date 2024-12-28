<?php



class Servicos extends Model
{

   

    public function getServicos()
    {



        $sql = "SELECT * FROM tbl_servico WHERE status_servico = 'Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getGaleriaPorId($id)
    {
        $sql = "SELECT * FROM tbl_galeria WHERE status_galeria ='Ativo' AND id_galeira = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array com os dados ou false
    }

}
