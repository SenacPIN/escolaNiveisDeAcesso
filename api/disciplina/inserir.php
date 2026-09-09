<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('disciplina.cadastrar');

header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/disciplina.php");

$conexao = new Conexao();

$disciplina = new Disciplina($conexao);


$dados = json_decode(file_get_contents("php://input"), true);

$resultado = $disciplina->cadastrar(
$dados["nome_disciplina"],
$dados["carga_horaria"],
$dados["id_professor"]
);

echo json_encode($resultado);

