<?php
require_once __DIR__ . '/../config/autorizacao.php';
require_once __DIR__ . '/../classes/Usuario.php';

function exigirPermissaoApi(string $permissao): array
{
    $token = Autorizacao::tokenBearer();
    if (!$token) Autorizacao::responderErroApi(401, 'Token de autenticação não informado.');
    $usuario = (new Usuario())->buscarPorToken($token);
    if (!$usuario) Autorizacao::responderErroApi(401, 'Token inválido.');
    if (!Autorizacao::pode($permissao, $usuario)) Autorizacao::responderErroApi(403, 'Seu nível de acesso não permite esta operação.');
    return $usuario;
}
