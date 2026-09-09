<?php

require_once __DIR__ . "/../config/conexao.php";

class Professor
{
    private $conexao;

    public function __construct()
    {
        $db = new Conexao();
        $this->conexao = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM professor";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM professor WHERE id_professor = :id";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $cpf, $telefone, $especialidade)
    {
        $sql = "
            INSERT INTO professor
            (
                nome,
                cpf,
                telefone,
                especialidade
            )
            VALUES
            (
                :nome,
                :cpf,
                :telefone,
                :especialidade
            )
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':especialidade', $especialidade);

        return $stmt->execute();
    }

    public function editar($id, $nome, $cpf, $telefone, $especialidade)
    {
        $sql = "
            UPDATE professor
            SET
                nome = :nome,
                cpf = :cpf,
                telefone = :telefone,
                especialidade = :especialidade
            WHERE id_professor = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':especialidade', $especialidade);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM professor WHERE id_professor = :id";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
