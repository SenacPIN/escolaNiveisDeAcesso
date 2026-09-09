<?php

require_once __DIR__ . "/../config/conexao.php";

class Consulta
{
    private $conexao;

    public function __construct()
    {
        $db = new Conexao();
        $this->conexao = $db->conectar();
    }

    public function totalAlunos()
    {
        $sql = "SELECT COUNT(*) AS total FROM aluno";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalProfessores()
    {
        $sql = "SELECT COUNT(*) AS total FROM professor";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalTurmas()
    {
        $sql = "SELECT COUNT(*) AS total FROM turma";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalDisciplinas()
    {
        $sql = "SELECT COUNT(*) AS total FROM disciplina";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function totalMatriculas()
    {
        $sql = "SELECT COUNT(*) AS total FROM matricula";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function alunosTurma()
    {
        $sql = "
            SELECT
                a.nome,
                t.nome_turma,
                t.serie
            FROM matricula m
            INNER JOIN aluno a
                ON m.id_aluno = a.id_aluno
            INNER JOIN turma t
                ON m.id_turma = t.id_turma
            ORDER BY a.nome
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function disciplinasProfessor()
    {
        $sql = "
            SELECT
                d.nome_disciplina,
                d.carga_horaria,
                p.nome
            FROM disciplina d
            INNER JOIN professor p
                ON d.id_professor = p.id_professor
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function matriculasCompletas()
    {
        $sql = "
            SELECT
                a.nome AS aluno,
                t.nome_turma,
                p.nome AS professor,
                m.status
            FROM matricula m
            INNER JOIN aluno a
                ON m.id_aluno = a.id_aluno
            INNER JOIN turma t
                ON m.id_turma = t.id_turma
            INNER JOIN professor p
                ON t.id_professor = p.id_professor
        ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
