<?php



class Banner extends Model
{

    // METODO PARA PEGAR FOTOS DA GALERIA

    public function getBanner()
    {



        $sql = "SELECT * FROM tbl_banner WHERE status_banner = 'Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getBanner_produto()
    {



        $sql = "SELECT * FROM tbl_banner WHERE id_banner = 2  AND status_banner ='Ativo'";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getbannerPorId($id)
    {
        $sql = "SELECT * FROM tbl_banner WHERE status_banner ='Ativo' AND id_banner = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna um array com os dados ou false
    }












}
