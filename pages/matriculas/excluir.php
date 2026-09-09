<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('matricula.excluir');

require_once "../../classes/matricula.php";

$matricula = new Matricula();

$id = $_GET['id'];

$matricula->excluir($id);

header("Location: listar.php");
exit;
