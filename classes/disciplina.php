<?php

require_once __DIR__ . "/../config/conexao.php";

class Disciplina
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
                d.*,
                p.nome AS professor
            FROM disciplina d
            LEFT JOIN professor p
                ON d.id_professor = p.id_professor
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM disciplina WHERE id_disciplina = :id";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar(
        $nome_disciplina,
        $carga_horaria,
        $id_professor
    ) {
        $sql = "
            INSERT INTO disciplina
            (
                nome_disciplina,
                carga_horaria,
                id_professor
            )
            VALUES
            (
                :nome_disciplina,
                :carga_horaria,
                :id_professor
            )
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':nome_disciplina', $nome_disciplina);
        $stmt->bindParam(':carga_horaria', $carga_horaria);
        $stmt->bindParam(':id_professor', $id_professor);

        return $stmt->execute();
    }

    public function editar(
        $id,
        $nome_disciplina,
        $carga_horaria,
        $id_professor
    ) {
        $sql = "
            UPDATE disciplina
            SET
                nome_disciplina = :nome_disciplina,
                carga_horaria = :carga_horaria,
                id_professor = :id_professor
            WHERE id_disciplina = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome_disciplina', $nome_disciplina);
        $stmt->bindParam(':carga_horaria', $carga_horaria);
        $stmt->bindParam(':id_professor', $id_professor);

        return $stmt->execute();
    }

    public function excluir($id)
    {
        $sql = "
            DELETE FROM disciplina
            WHERE id_disciplina = :id
        ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
