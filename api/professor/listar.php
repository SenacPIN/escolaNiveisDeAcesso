<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('professor.listar');
header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/professor.php");

$professor = new Professor();

$resultado = $professor->listar();
echo json_encode($resultado);
