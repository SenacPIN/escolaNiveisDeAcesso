<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('turma.editar');

require_once "../../classes/turma.php";
require_once "../../classes/professor.php";

$turma = new Turma();
$professor = new Professor();

$id = $_GET['id'];

$dados = $turma->buscarPorId($id);

$professores = $professor->listar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $turma->editar(
        $id,
        $_POST['nome_turma'],
        $_POST['serie'],
        $_POST['ano_letivo'],
        $_POST['id_professor']
    );

    header("Location: listar.php");
    exit;
}

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<h2>Editar Turma</h2>

<form method="POST">

    <input
        type="text"
        name="nome_turma"
        value="<?= $dados['nome_turma'] ?>"
        required>

    <br><br>

    <input
        type="text"
        name="serie"
        value="<?= $dados['serie'] ?>"
        required>

    <br><br>

    <input
        type="number"
        name="ano_letivo"
        value="<?= $dados['ano_letivo'] ?>"
        required>

    <br><br>

    <select name="id_professor">

        <?php foreach ($professores as $prof): ?>

            <option
                value="<?= $prof['id_professor'] ?>"
                <?= $prof['id_professor'] == $dados['id_professor'] ? 'selected' : '' ?>>

                <?= $prof['nome'] ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">
        Atualizar
    </button>

</form>

<?php include "../../includes/footer.php"; ?>
