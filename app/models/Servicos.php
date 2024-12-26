<?php



class Servicos extends Model
{

   

    public function getServicos()
    {



        $sql = "SELECT * FROM tbl_servico WHERE status_servico = 'Ativo' AND id_servico  IN (3,4,5,6,7,8);";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
