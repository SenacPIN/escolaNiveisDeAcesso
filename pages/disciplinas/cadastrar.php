<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('disciplina.cadastrar');

require_once "../../classes/disciplina.php";
require_once "../../classes/professor.php";

$disciplina = new Disciplina();
$professor = new Professor();

$professores = $professor->listar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $disciplina->cadastrar(
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

<h2>Cadastrar Disciplina</h2>

<form method="POST">

    <p>
        Nome da Disciplina:<br>
        <input type="text"
            name="nome_disciplina"
            required>
    </p>

    <p>
        Carga Horária:<br>
        <input type="number"
            name="carga_horaria"
            required>
    </p>

    <p>

        Professor:<br>

        <select name="id_professor" required>

            <?php foreach ($professores as $prof): ?>

                <option value="<?= $prof['id_professor'] ?>">
                    <?= $prof['nome'] ?>
                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <button type="submit">
        Salvar
    </button>

</form>

<?php include "../../includes/footer.php"; ?>
