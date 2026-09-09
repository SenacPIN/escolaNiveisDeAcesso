<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('professor.editar');
header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/professor.php");

$conexao = new Conexao();
$professor = new Professor($conexao);

$dados = json_decode(file_get_contents("php://input"),true);

$resultado = $professor->editar(
    $dados["id_professor"], 
    $dados["nome"], 
    $dados["cpf"], 
    $dados["telefone"], 
    $dados["especialidade"]
);

echo json_encode($resultado);
