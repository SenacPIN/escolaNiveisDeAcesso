<?php
$url = "http://localhost/escola/api/aluno/listar.php";

$resposta = file_get_contents($url);

$alunos = json_decode($resposta, true);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste - file_get_contents</title>
</head>

<body>
    <h1>Consumo de API com file_get_contents()</h1>
    <hr>

    <?php foreach ($alunos as $aluno): ?>

        <h3><?= $aluno['nome'] ?></h3>

        <p>
            <strong>Data de nascimento:</strong>
            <?= $aluno['data_nasc'] ?>
        </p>

        <p>
            <strong>Endereço:</strong>
            <?= $aluno['endereco'] ?>
        </p>

        <hr>

    <?php endforeach; ?>

</body>
</html>

