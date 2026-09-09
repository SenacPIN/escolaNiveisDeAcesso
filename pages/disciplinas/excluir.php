<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('disciplina.excluir');

require_once "../../classes/disciplina.php";

$disciplina = new Disciplina();

$id = $_GET['id'];

$disciplina->excluir($id);

header("Location: listar.php");
exit;
