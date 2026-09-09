<?php
require_once __DIR__ . "/../config/autorizacao.php";
Autorizacao::exigir('consulta.visualizar');

require_once "../classes/consulta.php";

$consulta = new Consulta();

$dados = $consulta->alunosTurma();

include "../includes/header.php";
include "../includes/menu.php";
?>

<h2>Alunos por Turma</h2>

<table border="1">

    <tr>
        <th>Aluno</th>
        <th>Turma</th>
        <th>Série</th>
    </tr>

    <?php foreach ($dados as $linha): ?>

        <tr>
            <td><?= $linha['nome'] ?></td>
            <td><?= $linha['nome_turma'] ?></td>
            <td><?= $linha['serie'] ?></td>
        </tr>

    <?php endforeach; ?>

</table>

<?php include "../includes/footer.php"; ?>
