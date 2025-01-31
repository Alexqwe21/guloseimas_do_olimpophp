<?php



class Cliente extends Model
{





    public function buscarCliente($email)
    {





        $sql = "SELECT * FROM tbl_cliente WHERE email_cliente = :email AND status_cliente = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function salvarCliente($nome, $email, $cpf, $data_nasc, $telefone, $endereco, $bairro, $cidade, $sigla_estado, $senha){
        // Buscar o ID do estado com base na sigla fornecida
        $sqlEstado = "SELECT id_uf FROM tbl_estado WHERE sigla_uf= :sigla_estado LIMIT 1";
        $stmtEstado = $this->db->prepare($sqlEstado);
        $stmtEstado->bindValue(':sigla_estado', $sigla_estado);
        $stmtEstado->execute();

        $idEstado = $stmtEstado->fetchColumn();

        if (!$idEstado) {
            throw new Exception("Estado inválido: $sigla_estado");
        }

        // Inserir os dados do cliente, incluindo status_cliente como 'Ativo'
        $sql = "INSERT INTO tbl_cliente 
            (nome_cliente, cpf_cliente, data_nasc_cliente, email_cliente, senha_cliente, telefone_cliente, endereco_cliente, bairro_cliente, cidade_cliente, id_uf, status_cliente) 
            VALUES (:nome, :cpf, :data_nasc, :email, :senha, :telefone, :endereco, :bairro, :cidade, :id_uf, 'Ativo')";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':data_nasc', $data_nasc);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':id_uf', $idEstado);
        $stmt->bindValue(':senha', $senha);

        return $stmt->execute();
    }
}
