<?php
$url = "http://localhost/escola/api/aluno/listar.php";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resposta = curl_exec($ch);

curl_close($ch);

$alunos = json_decode($resposta, true);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consumo de API com cURL</title>
</head>
<body>

    <h1>Consumo de API com cURL</h1>
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

