<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('aluno.listar');

header("Content-Type: application/json; charset=UTF-8");

require_once("../../config/conexao.php");
require_once("../../classes/aluno.php");

$conexao = new Conexao();
$aluno = new Aluno($conexao);

$resultado = $aluno->listar();

echo json_encode($resultado);
