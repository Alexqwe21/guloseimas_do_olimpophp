<?php

class Contato extends Model
{

    //Salvar o email na base de dados
    public function salvarEmail($assunto, $nome, $email, $tel, $msg)
    {

        $sql = "INSERT INTO tbl_contato(assunto_contato, nome_contato, email_contato, telefone_contato, mensagem_contato)
                VALUE (:assuntoContato, :nomeContato, :emailContato, :telContato, :mensContato)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':assuntoContato', $assunto);
        $stmt->bindValue(':nomeContato', $nome);
        $stmt->bindValue(':emailContato', $email);
        $stmt->bindValue(':telContato', $tel);
        $stmt->bindValue(':mensContato', $msg);

        return $stmt->execute();
    }


    public function emails_contatos()
    {

        $sql = "SELECT * FROM tbl_contato";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function excluirContato($id_contato)
    {
        // Prepara a consulta SQL para excluir o contato
        $sql = "DELETE FROM tbl_contato WHERE id_contato = :id_contato";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_contato', $id_contato, PDO::PARAM_INT);

        // Executa a consulta e retorna o resultado
        return $stmt->execute();
    }


    public function excluirTodosEmails()
    {
        $sql = "DELETE FROM tbl_contato";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }
}
