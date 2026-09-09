<?php
require_once __DIR__ . "/../config/autorizacao.php";
Autorizacao::exigir('consulta.visualizar');

require_once "../classes/consulta.php";

$consulta = new Consulta();

$dados = $consulta->disciplinasProfessor();

include "../includes/header.php";
include "../includes/menu.php";
?>

<h2>Disciplinas por Professor</h2>

<table border="1">

    <tr>
        <th>Disciplina</th>
        <th>Carga Horária</th>
        <th>Professor</th>
    </tr>

    <?php foreach ($dados as $linha): ?>

        <tr>
            <td><?= $linha['nome_disciplina'] ?></td>
            <td><?= $linha['carga_horaria'] ?></td>
            <td><?= $linha['nome'] ?></td>
        </tr>

    <?php endforeach; ?>

</table>

<?php include "../includes/footer.php"; ?>
