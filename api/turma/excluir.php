<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('turma.excluir');
header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/turma.php");

$conexao = new Conexao();
$turma = new Turma($conexao);

$dados = json_decode(file_get_contents("php://input"),true);

$resultado = $turma->excluir(
    $dados["id_turma"]
);

echo json_encode($resultado);
