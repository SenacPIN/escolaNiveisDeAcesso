<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('professor.listar');

header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/professor.php");
$conexao = new Conexao();
$professor = new Professor($conexao);

$id = $_GET["id"];

$resultado = $professor->buscarPorId($id);

echo json_encode($resultado);
