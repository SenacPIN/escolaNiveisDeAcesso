<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('professor.editar');

require_once "../../classes/professor.php";

$professor = new Professor();

$id = $_GET['id'];

$dados = $professor->buscarPorId($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professor->editar(
        $id,
        $_POST['nome'],
        $_POST['cpf'],
        $_POST['telefone'],
        $_POST['especialidade']
    );

    header("Location: listar.php");
    exit;
}

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<h2>Editar Professor</h2>

<form method="POST">

    <p>
        Nome:<br>
        <input
            type="text"
            name="nome"
            value="<?= $dados['nome'] ?>"
            required>
    </p>

    <p>
        CPF:<br>
        <input
            type="text"
            name="cpf"
            value="<?= $dados['cpf'] ?>"
            required>
    </p>

    <p>
        Telefone:<br>
        <input
            type="text"
            name="telefone"
            value="<?= $dados['telefone'] ?>">
    </p>

    <p>
        Especialidade:<br>
        <input
            type="text"
            name="especialidade"
            value="<?= $dados['especialidade'] ?>">
    </p>

    <br>

    <button type="submit">
        Atualizar
    </button>

</form>

<?php
include "../../includes/footer.php";
?>
