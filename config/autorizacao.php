<?php

class Autorizacao
{
    private const PERMISSOES = [
        'aluno' => ['aluno.listar', 'professor.listar', 'turma.listar', 'disciplina.listar', 'matricula.listar', 'consulta.visualizar'],
        'professor' => ['aluno.listar', 'professor.listar', 'turma.listar', 'turma.cadastrar', 'disciplina.listar', 'matricula.listar', 'consulta.visualizar'],
        'secretaria' => [
            'aluno.listar', 'aluno.cadastrar', 'aluno.editar', 'aluno.excluir',
            'professor.listar',
            'turma.listar', 'turma.cadastrar', 'turma.editar', 'turma.excluir',
            'disciplina.listar', 'disciplina.cadastrar', 'disciplina.editar', 'disciplina.excluir',
            'matricula.listar', 'matricula.cadastrar', 'matricula.editar', 'matricula.excluir',
            'consulta.visualizar'
        ],
        'direcao' => ['*'],
    ];

    public static function iniciarSessao(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    }

    public static function usuario(): ?array
    {
        self::iniciarSessao();
        return $_SESSION['usuario'] ?? null;
    }

    public static function pode(string $permissao, ?array $usuario = null): bool
    {
        $usuario ??= self::usuario();
        if (!$usuario || empty($usuario['nivel_acesso'])) return false;
        $permissoes = self::PERMISSOES[strtolower($usuario['nivel_acesso'])] ?? [];
        return in_array('*', $permissoes, true) || in_array($permissao, $permissoes, true);
    }

    public static function exigirLogin(): void
    {
        if (self::usuario()) return;
        header('Location: ' . self::baseUrl() . '/login.php');
        exit;
    }

    public static function exigir(string $permissao): void
    {
        self::exigirLogin();
        if (self::pode($permissao)) return;
        http_response_code(403);
        $permissaoNegada = $permissao;
        require __DIR__ . '/../pages/acesso-negado.php';
        exit;
    }

    public static function baseUrl(): string
    {
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        foreach (['/pages/', '/consultas/', '/api/'] as $marcador) {
            $posicao = strpos($script, $marcador);
            if ($posicao !== false) return substr($script, 0, $posicao);
        }
        return rtrim(dirname($script), '/.');
    }

    public static function tokenBearer(): ?string
    {
        $cabecalho = $_SERVER['HTTP_AUTHORIZATION']
            ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
            ?? '';

        if ($cabecalho === '' && function_exists('getallheaders')) {
            foreach (getallheaders() as $nome => $valor) {
                if (strcasecmp($nome, 'Authorization') === 0) {
                    $cabecalho = $valor;
                    break;
                }
            }
        }

        return preg_match('/^Bearer\s+(\S+)$/i', $cabecalho, $partes) ? $partes[1] : null;
    }

    public static function responderErroApi(int $status, string $mensagem): never
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode(['erro' => $mensagem], JSON_UNESCAPED_UNICODE);
        exit;
    }
}
