<?php

class Conexao
{
    private $host = "localhost";
    private $dbname = "escola";
    private $usuario = "root";
    private $senha = "1234";
    private $porta = 3306;

    public function __construct()
    {
        $servidor = strtolower($_SERVER['SERVER_NAME'] ?? 'localhost');

        if (in_array($servidor, ['escola.site.je', 'www.escola.site.je'], true)) {
            $this->host = 'sql112.infinityfree.com';
            $this->dbname = 'if0_42874153_escola';
            $this->usuario = 'if0_42874153';
            $this->senha = 'TcvYXbXMJZ';
        }
    }

    public function conectar()
    {
        try {

            $conexao = new PDO(
                "mysql:host={$this->host};port={$this->porta};dbname={$this->dbname};charset=utf8",
                $this->usuario,
                $this->senha
            );

            $conexao->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conexao;

        } catch (PDOException $erro) {

            die("Erro na conexão: " . $erro->getMessage());

        }
    }
}
