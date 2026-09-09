<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('turma.listar');
header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/turma.php");

$turma = new Turma();

$resultado = $turma->listar();
echo json_encode($resultado);
