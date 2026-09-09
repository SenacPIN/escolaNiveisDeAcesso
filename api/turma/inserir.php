<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('turma.cadastrar');

header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/turma.php");

$conexao = new Conexao();

$turma = new Turma($conexao);


$dados = json_decode(file_get_contents("php://input"), true);

$resultado = $turma->cadastrar(
$dados["nome_turma"],
$dados["serie"],
$dados["ano_letivo"],
$dados["id_professor"]
);

echo json_encode($resultado);

