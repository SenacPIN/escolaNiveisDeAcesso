<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('matricula.listar');
header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/matricula.php");

$matricula = new Matricula();

$resultado = $matricula->listar();
echo json_encode($resultado);
