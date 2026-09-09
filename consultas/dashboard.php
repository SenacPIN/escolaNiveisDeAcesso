<?php
require_once __DIR__ . "/../config/autorizacao.php";
Autorizacao::exigir('consulta.visualizar');

require_once "../classes/consulta.php";

$consulta = new Consulta();

$alunos = $consulta->totalAlunos();
$professores = $consulta->totalProfessores();
$turmas = $consulta->totalTurmas();
$disciplinas = $consulta->totalDisciplinas();
$matriculas = $consulta->totalMatriculas();

include "../includes/header.php";
include "../includes/menu.php";

?>

<div class="container">

    <h1>Central de Consultas</h1>

    <div class="dashboard">

        <div class="dashboard-card">
            <h3>Alunos</h3>
            <p><?= $alunos['total'] ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Professores</h3>
            <p><?= $professores['total'] ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Turmas</h3>
            <p><?= $turmas['total'] ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Disciplinas</h3>
            <p><?= $disciplinas['total'] ?></p>
        </div>

        <div class="dashboard-card">
            <h3>Matrículas</h3>
            <p><?= $matriculas['total'] ?></p>
        </div>

    </div>

    <div class="card">

        <h2>Relatórios Disponíveis</h2>

        <table>

            <tr>
                <th>Consulta</th>
                <th>Ação</th>
            </tr>

            <tr>
                <td>Alunos por Turma</td>
                <td>
                    <a class="editar"
                        href="alunos_turma.php">
                        Visualizar
                    </a>
                </td>
            </tr>

            <tr>
                <td>Disciplinas por Professor</td>
                <td>
                    <a class="editar"
                        href="disciplinas_professor.php">
                        Visualizar
                    </a>
                </td>
            </tr>

            <tr>
                <td>Matrículas Completas</td>
                <td>
                    <a class="editar"
                        href="matriculas_completas.php">
                        Visualizar
                    </a>
                </td>
            </tr>

        </table>

    </div>

</div>

<?php

include "../includes/footer.php";

?>
