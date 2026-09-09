<?php
require_once __DIR__ . "/../config/autorizacao.php";
Autorizacao::exigir('consulta.visualizar');

require_once "../classes/consulta.php";

$consulta = new Consulta();

$dados = $consulta->matriculasCompletas();

include "../includes/header.php";
include "../includes/menu.php";
?>

<h2>Matrículas Completas</h2>

<table border="1">

    <tr>
        <th>Aluno</th>
        <th>Turma</th>
        <th>Professor</th>
        <th>Status</th>
    </tr>

    <?php foreach ($dados as $linha): ?>

        <tr>
            <td><?= $linha['aluno'] ?></td>
            <td><?= $linha['nome_turma'] ?></td>
            <td><?= $linha['professor'] ?></td>
            <td><?= $linha['status'] ?></td>
        </tr>

    <?php endforeach; ?>

</table>

<?php include "../includes/footer.php"; ?>
