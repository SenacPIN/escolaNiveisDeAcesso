<?php

$url = "http://localhost/escola/api/aluno/listar.php";

$resposta = file_get_contents($url);

$alunos = json_decode($resposta, true);

foreach ($alunos as $aluno) {

    echo "Nome: " . $aluno['nome'] . "<br>";
    echo "Data de nascimento: " . $aluno['data_nasc'] . "<br>";
    echo "Endereço: " . $aluno['endereco'] . "<br>";

    echo "<hr>";
}

