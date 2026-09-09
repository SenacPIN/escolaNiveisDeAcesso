<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('aluno.cadastrar');

require_once "../../classes/aluno.php";

$aluno = new Aluno();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno->cadastrar(
        $_POST['nome'],
        $_POST['data_nasc'],
        $_POST['cpf'],
        $_POST['endereco'],
        $_POST['telefone']
    );

    header("Location: listar.php");
    exit;
}

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<h2>Cadastrar Aluno</h2>

<form method="POST">

    <p>
        Nome:<br>
        <input type="text" name="nome" required>
    </p>

    <p>
        Data Nascimento:<br>
        <input type="date" name="data_nasc" required>
    </p>

    <p>
        CPF:<br>
        <input type="text" name="cpf" required>
    </p>

    <p>
        Endereço:<br>
        <input type="text" name="endereco">
    </p>

    <p>
        Telefone:<br>
        <input type="text" name="telefone">
    </p>

    <br>

    <button type="submit">
        Salvar
    </button>

</form>

<?php
include "../../includes/footer.php";
?>
