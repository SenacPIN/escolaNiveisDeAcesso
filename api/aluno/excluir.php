<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('aluno.excluir');

header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/aluno.php");

$conexao = new Conexao();

$aluno = new Aluno($conexao);

$dados = json_decode(file_get_contents("php://input"), true);

$resultado = $aluno->excluir(

    $dados["id_aluno"]

);

echo json_encode($resultado);
