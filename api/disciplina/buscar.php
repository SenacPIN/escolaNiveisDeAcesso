<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('disciplina.listar');

header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/disciplina.php");
$conexao = new Conexao();
$disciplina = new Disciplina($conexao);

$id = $_GET["id"];

$resultado = $disciplina->buscarPorId($id);

echo json_encode($resultado);
