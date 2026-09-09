<?php
require_once __DIR__ . '/config/autorizacao.php';
Autorizacao::iniciarSessao();
$_SESSION = [];
session_destroy();
header('Location: login.php');
exit;
