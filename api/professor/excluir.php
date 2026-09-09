<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('professor.excluir');
header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/professor.php");

$conexao = new Conexao();
$professor = new Professor($conexao);

$dados = json_decode(file_get_contents("php://input"),true);

$resultado = $professor->excluir(
    $dados["id_professor"]
);

echo json_encode($resultado);
