<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('turma.cadastrar');

require_once "../../classes/turma.php";
require_once "../../classes/professor.php";

$turma = new Turma();
$professor = new Professor();

$professores = $professor->listar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $turma->cadastrar(
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

<h2>Cadastrar Turma</h2>

<form method="POST">

    <p>
        Nome da Turma:<br>
        <input type="text" name="nome_turma" required>
    </p>

    <p>
        Série:<br>
        <input type="text" name="serie" required>
    </p>

    <p>
        Ano Letivo:<br>
        <input type="number" name="ano_letivo" required>
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
