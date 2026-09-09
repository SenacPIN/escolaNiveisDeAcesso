<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('matricula.editar');
header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/matricula.php");

$conexao = new Conexao();
$matricula = new matricula($conexao);

$dados = json_decode(file_get_contents("php://input"),true);

$resultado = $matricula->editar(
    $dados["id_matricula"], 
    $dados["data_matricula"], 
    $dados["status"], 
    $dados["id_aluno"],
    $dados["id_turma"]
);

echo json_encode($resultado);
