<?php

$url = "http://localhost/escola/api/aluno/listar.php";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resposta = curl_exec($ch);

if ($resposta === false) {
    echo "Erro no cURL: " . curl_error($ch);
} else {
    echo "<h2>Resposta da API:</h2>";
    echo "<pre>";
    echo $resposta;
    echo "</pre>";
}

curl_close($ch);

