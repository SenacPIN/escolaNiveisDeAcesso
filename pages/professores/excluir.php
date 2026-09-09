<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('professor.excluir');

require_once "../../classes/professor.php";

$professor = new Professor();

$id = $_GET['id'];

$professor->excluir($id);

header("Location: listar.php");
exit;
