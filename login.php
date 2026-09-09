<?php
require_once __DIR__ . '/classes/Usuario.php';
require_once __DIR__ . '/config/autorizacao.php';
Autorizacao::iniciarSessao();
if (Autorizacao::usuario()) { header('Location: index.php'); exit; }
$erro = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $usuario = $email ? (new Usuario())->autenticar($email, (string) ($_POST['senha'] ?? '')) : null;
    if ($usuario) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = ['id_usuario' => $usuario['id_usuario'], 'nome' => $usuario['nome'], 'email' => $usuario['email'], 'nivel_acesso' => $usuario['nivel_acesso']];
        header('Location: index.php'); exit;
    }
    $erro = 'E-mail ou senha inválidos.';
}
include __DIR__ . '/includes/header.php';
?>
<div class="container login-container"><div class="card">
    <h1>Acesso ao Sistema Escolar</h1>
    <?php if ($erro): ?><p class="alerta erro"><?= htmlspecialchars($erro) ?></p><?php endif; ?>
    <form method="POST">
        <p><label>E-mail<br><input type="email" name="email" required></label></p>
        <p><label>Senha<br><input type="password" name="senha" required></label></p>
        <button type="submit">Entrar</button>
    </form>
</div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
