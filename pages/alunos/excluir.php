<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('aluno.excluir');

require_once "../../classes/aluno.php";

$aluno = new Aluno();

$id = $_GET['id'];

$aluno->excluir($id);

header("Location: listar.php");
exit;
