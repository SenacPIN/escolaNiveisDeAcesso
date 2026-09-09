<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('disciplina.listar');
header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/disciplina.php");

$disciplina = new Disciplina();

$resultado = $disciplina->listar();
echo json_encode($resultado);
