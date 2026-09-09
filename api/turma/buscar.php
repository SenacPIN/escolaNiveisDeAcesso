<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('turma.listar');

header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/turma.php");
$conexao = new Conexao();
$turma = new turma($conexao);

$id = $_GET["id"];

$resultado = $turma->buscarPorId($id);

echo json_encode($resultado);
