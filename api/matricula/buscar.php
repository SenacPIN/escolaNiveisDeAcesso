<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('matricula.listar');

header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/matricula.php");
$conexao = new Conexao();
$matricula = new Matricula($conexao);

$id = $_GET["id"];

$resultado = $matricula->buscarPorId($id);

echo json_encode($resultado);
