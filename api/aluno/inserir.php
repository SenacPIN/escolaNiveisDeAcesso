<?php
require_once __DIR__ . '/../autorizacao.php';
exigirPermissaoApi('aluno.cadastrar');

header("Content-Type: application/json");

require_once("../../config/conexao.php");
require_once("../../classes/aluno.php");

$conexao = new Conexao();

$aluno = new Aluno($conexao);

/*
Receberemos os dados enviados pelo cliente.
Na próxima seção aprenderemos como esses dados são obtidos.
*/

$dados = json_decode(file_get_contents("php://input"), true);

$resultado = $aluno-> cadastrar(
    $dados["nome"],
    $dados["data_nasc"],
    $dados["cpf"],
    $dados["endereco"],
    $dados["telefone"]
);

echo json_encode($resultado);
