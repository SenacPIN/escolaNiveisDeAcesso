<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('matricula.cadastrar');

require_once "../../classes/matricula.php";
require_once "../../classes/aluno.php";
require_once "../../classes/turma.php";

$matricula = new Matricula();

$aluno = new Aluno();
$turma = new Turma();

$alunos = $aluno->listarNaoMatriculados();

if (count($alunos) == 0) {
    include "../../includes/header.php";
    include "../../includes/menu.php";

    echo "<h2>Nova Matrícula</h2>";
    echo "<p>Todos os alunos já estão matriculados.</p>";

    include "../../includes/footer.php";

    exit;
}

$turmas = $turma->listar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula->cadastrar(
        $_POST['data_matricula'],
        $_POST['status'],
        $_POST['id_aluno'],
        $_POST['id_turma']
    );

    header("Location: listar.php");
    exit;
}

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<h2>Nova Matrícula</h2>

<form method="POST">

    <p>
        Data:<br>
        <input type="date"
            name="data_matricula"
            required>
    </p>

    <p>
        Status:<br>

        <select name="status">

            <option>Ativa</option>
            <option>Trancada</option>
            <option>Concluida</option>
            <option>Cancelada</option>

        </select>
    </p>

    <p>
        Aluno:<br>

        <select name="id_aluno">

            <?php foreach ($alunos as $a): ?>

                <option value="<?= $a['id_aluno'] ?>">
                    <?= $a['nome'] ?>
                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <p>
        Turma:<br>

        <select name="id_turma">

            <?php foreach ($turmas as $t): ?>

                <option value="<?= $t['id_turma'] ?>">
                    <?= $t['nome_turma'] ?>
                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <button type="submit">
        Salvar
    </button>

</form>

<?php include "../../includes/footer.php"; ?>
