<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('aluno.editar');

require_once "../../classes/aluno.php";

$aluno = new Aluno();

$id = $_GET['id'];

$dados = $aluno->buscarPorId($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno->editar(
        $id,
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

<h2>Editar Aluno</h2>

<form method="POST">

    <p>
        Nome:<br>
        <input
            type="text"
            name="nome"
            value="<?= $dados['nome']; ?>"
            required>
    </p>

    <p>
        Data Nascimento:<br>
        <input
            type="date"
            name="data_nasc"
            value="<?= $dados['data_nasc']; ?>"
            required>
    </p>

    <p>
        CPF:<br>
        <input
            type="text"
            name="cpf"
            value="<?= $dados['cpf']; ?>"
            required>
    </p>

    <p>
        Endereço:<br>
        <input
            type="text"
            name="endereco"
            value="<?= $dados['endereco']; ?>">
    </p>

    <p>
        Telefone:<br>
        <input
            type="text"
            name="telefone"
            value="<?= $dados['telefone']; ?>">
    </p>

    <br>

    <button type="submit">
        Atualizar
    </button>

</form>

<?php
include "../../includes/footer.php";
?>
