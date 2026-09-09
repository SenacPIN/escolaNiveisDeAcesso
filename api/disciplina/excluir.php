<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('disciplina.excluir');
header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/disciplina.php");

$conexao = new Conexao();
$disciplina = new Disciplina($conexao);

$dados = json_decode(file_get_contents("php://input"),true);

$resultado = $disciplina->excluir(
    $dados["id_disciplina"]
);

echo json_encode($resultado);
