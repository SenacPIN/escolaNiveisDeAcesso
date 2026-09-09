<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('matricula.editar');

require_once "../../classes/matricula.php";
require_once "../../classes/aluno.php";
require_once "../../classes/turma.php";

$matricula = new Matricula();

$aluno = new Aluno();
$turma = new Turma();

$id = $_GET['id'];

$dados = $matricula->buscarPorId($id);

$alunos = $aluno->listar();
$turmas = $turma->listar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula->editar(
        $id,
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

<h2>Editar Matrícula</h2>

<form method="POST">

    <p>
        Data:<br>
        <input
            type="date"
            name="data_matricula"
            value="<?= $dados['data_matricula'] ?>">
    </p>

    <p>

        Status:<br>

        <select name="status">

            <option <?= $dados['status'] == 'Ativa' ? 'selected' : '' ?>>
                Ativa
            </option>

            <option <?= $dados['status'] == 'Trancada' ? 'selected' : '' ?>>
                Trancada
            </option>

            <option <?= $dados['status'] == 'Concluida' ? 'selected' : '' ?>>
                Concluida
            </option>

            <option <?= $dados['status'] == 'Cancelada' ? 'selected' : '' ?>>
                Cancelada
            </option>

        </select>

    </p>

    <p>

        Aluno:<br>

        <select name="id_aluno">

            <?php foreach ($alunos as $a): ?>

                <option
                    value="<?= $a['id_aluno'] ?>"
                    <?= $a['id_aluno'] == $dados['id_aluno'] ? 'selected' : '' ?>>

                    <?= $a['nome'] ?>

                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <p>

        Turma:<br>

        <select name="id_turma">

            <?php foreach ($turmas as $t): ?>

                <option
                    value="<?= $t['id_turma'] ?>"
                    <?= $t['id_turma'] == $dados['id_turma'] ? 'selected' : '' ?>>

                    <?= $t['nome_turma'] ?>

                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <button type="submit">
        Atualizar
    </button>

</form>

<?php include "../../includes/footer.php"; ?>
