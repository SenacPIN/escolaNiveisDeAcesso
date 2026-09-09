<?php

require_once __DIR__ . "/../config/conexao.php";

class Turma
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
                t.*,
                p.nome as professor
            FROM turma t
            LEFT JOIN professor p
            ON t.id_professor = p.id_professor
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM turma WHERE id_turma = :id";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar(
        $nome_turma,
        $serie,
        $ano_letivo,
        $id_professor
    ) {
        $sql = "
            INSERT INTO turma
            (
                nome_turma,
                serie,
                ano_letivo,
                id_professor
            )
            VALUES
            (
                :nome_turma,
                :serie,
                :ano_letivo,
                :id_professor
            )
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':nome_turma', $nome_turma);
        $stmt->bindParam(':serie', $serie);
        $stmt->bindParam(':ano_letivo', $ano_letivo);
        $stmt->bindParam(':id_professor', $id_professor);

        return $stmt->execute();
    }

    public function editar(
        $id,
        $nome_turma,
        $serie,
        $ano_letivo,
        $id_professor
    ) {
        $sql = "
            UPDATE turma
            SET
                nome_turma = :nome_turma,
                serie = :serie,
                ano_letivo = :ano_letivo,
                id_professor = :id_professor
            WHERE id_turma = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome_turma', $nome_turma);
        $stmt->bindParam(':serie', $serie);
        $stmt->bindParam(':ano_letivo', $ano_letivo);
        $stmt->bindParam(':id_professor', $id_professor);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM turma WHERE id_turma = :id";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
