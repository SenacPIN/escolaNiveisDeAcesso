<?php

require_once __DIR__ . "/../config/conexao.php";

class Matricula
{
    private $conexao;

    public function __construct()
    {
        $db = new Conexao();
        $this->conexao = $db->conectar();
    }

    public function listar()
    {
        $sql = "
            SELECT
                m.*,
                a.nome AS aluno,
                t.nome_turma
            FROM matricula m
            INNER JOIN aluno a
                ON m.id_aluno = a.id_aluno
            INNER JOIN turma t
                ON m.id_turma = t.id_turma
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "
            SELECT *
            FROM matricula
            WHERE id_matricula = :id
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar(
        $data_matricula,
        $status,
        $id_aluno,
        $id_turma
    ) {
        $sql = "
            INSERT INTO matricula
            (
                data_matricula,
                status,
                id_aluno,
                id_turma
            )
            VALUES
            (
                :data_matricula,
                :status,
                :id_aluno,
                :id_turma
            )
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':data_matricula', $data_matricula);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->bindParam(':id_turma', $id_turma);

        return $stmt->execute();
    }

    public function editar(
        $id,
        $data_matricula,
        $status,
        $id_aluno,
        $id_turma
    ) {
        $sql = "
            UPDATE matricula
            SET
                data_matricula = :data_matricula,
                status = :status,
                id_aluno = :id_aluno,
                id_turma = :id_turma
            WHERE id_matricula = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':data_matricula', $data_matricula);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_aluno', $id_aluno);
        $stmt->bindParam(':id_turma', $id_turma);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        $sql = "
            DELETE FROM matricula
            WHERE id_matricula = :id
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
