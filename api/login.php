<?php
header('Content-Type: application/json; charset=UTF-8');
require_once __DIR__ . '/../classes/Usuario.php';
$dados = json_decode(file_get_contents('php://input'), true) ?: [];
$email = filter_var($dados['email'] ?? '', FILTER_VALIDATE_EMAIL);
$senha = (string) ($dados['senha'] ?? '');
if (!$email || $senha === '') {
    http_response_code(400);
    echo json_encode(['erro' => 'E-mail e senha são obrigatórios.'], JSON_UNESCAPED_UNICODE);
    exit;
}
$repositorio = new Usuario();
$usuario = $repositorio->autenticar($email, $senha);
if (!$usuario) {
    http_response_code(401);
    echo json_encode(['erro' => 'Credenciais inválidas.'], JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode(['token' => $repositorio->gerarToken((int) $usuario['id_usuario']), 'tipo' => 'Bearer', 'nivel_acesso' => $usuario['nivel_acesso']], JSON_UNESCAPED_UNICODE);
