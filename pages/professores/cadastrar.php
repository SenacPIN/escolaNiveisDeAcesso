<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('professor.cadastrar');

require_once "../../classes/professor.php";

$professor = new Professor();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professor->cadastrar(
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

<h2>Cadastrar Professor</h2>

<form method="POST">

    <p>
        Nome:<br>
        <input type="text" name="nome" required>
    </p>

    <p>
        CPF:<br>
        <input type="text" name="cpf" required>
    </p>

    <p>
        Telefone:<br>
        <input type="text" name="telefone">
    </p>

    <p>
        Especialidade:<br>
        <input type="text" name="especialidade">
    </p>

    <br>

    <button type="submit">
        Salvar
    </button>

</form>

<?php
include "../../includes/footer.php";
?>
