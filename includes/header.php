<?php
require_once __DIR__ . '/../config/autorizacao.php';
$paginaLogin = basename($_SERVER['SCRIPT_NAME'] ?? '') === 'login.php';
if (!$paginaLogin) Autorizacao::exigirLogin();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

      <meta charset="UTF-8">

      <meta name="viewport"
            content="width=device-width, initial-scale=1.0">

      <title>Sistema Escolar</title>

      <link rel="stylesheet" href="/escola/assets/css/style.css">

</head>

<body>


      <main>
