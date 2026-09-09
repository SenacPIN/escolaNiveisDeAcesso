<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('matricula.excluir');
header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/matricula.php");

$conexao = new Conexao();
$matricula = new matricula($conexao);

$dados = json_decode(file_get_contents("php://input"),true);

$resultado = $matricula->excluir(
    $dados["id_matricula"]
);

echo json_encode($resultado);
