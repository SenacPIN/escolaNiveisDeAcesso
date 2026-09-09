<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('disciplina.editar');

require_once "../../classes/disciplina.php";
require_once "../../classes/professor.php";

$disciplina = new Disciplina();
$professor = new Professor();

$id = $_GET['id'];

$dados = $disciplina->buscarPorId($id);

$professores = $professor->listar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $disciplina->editar(
        $id,
        $_POST['nome_disciplina'],
        $_POST['carga_horaria'],
        $_POST['id_professor']
    );

    header("Location: listar.php");
    exit;
}

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<h2>Editar Disciplina</h2>

<form method="POST">

    <p>
        Nome da Disciplina:<br>
        <input
            type="text"
            name="nome_disciplina"
            value="<?= $dados['nome_disciplina'] ?>"
            required>
    </p>

    <p>
        Carga Horária:<br>
        <input
            type="number"
            name="carga_horaria"
            value="<?= $dados['carga_horaria'] ?>"
            required>
    </p>

    <p>

        Professor:<br>

        <select name="id_professor">

            <?php foreach ($professores as $prof): ?>

                <option
                    value="<?= $prof['id_professor'] ?>"
                    <?= ($prof['id_professor'] == $dados['id_professor']) ? 'selected' : '' ?>>

                    <?= $prof['nome'] ?>

                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <button type="submit">
        Atualizar
    </button>

</form>

<?php include "../../includes/footer.php"; ?>
