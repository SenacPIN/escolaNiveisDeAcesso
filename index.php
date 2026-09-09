<?php
require_once __DIR__ . "/config/autorizacao.php";
Autorizacao::exigirLogin();

require_once "config/conexao.php";

include "includes/header.php";
include "includes/menu.php";

$conexao = new Conexao();
$db = $conexao->conectar();

?>

<div class="container">

    <div class="card">

        <h1>Sistema Escolar</h1>

        <p>
            Projeto desenvolvido utilizando:
        </p>

        <ul>
            <li>PHP</li>
            <li>MySQL</li>
            <li>HTML</li>
            <li>CSS</li>
            <li>JavaScript</li>
        </ul>

        <br>

        <p> Banco conectado com sucesso! </p>

    </div>

</div>

<?php

include "includes/footer.php";

?>
