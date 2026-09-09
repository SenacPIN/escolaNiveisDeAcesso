<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('aluno.editar');

header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/aluno.php");

$conexao = new Conexao();

$aluno = new Aluno($conexao);

$dados = json_decode(file_get_contents("php://input"), true);

$resultado = $aluno->editar(

    $dados["id_aluno"],
    $dados["nome"],
    $dados["data_nasc"],
    $dados["cpf"],
    $dados["endereco"],
    $dados["telefone"]

);

echo json_encode($resultado);
