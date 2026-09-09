<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/menu.php';
?>
<div class="container"><div class="card">
    <h1>Acesso negado</h1>
    <p class="alerta erro">Seu perfil não possui a permissão <strong><?= htmlspecialchars($permissaoNegada ?? '') ?></strong>.</p>
    <p><a href="<?= htmlspecialchars(Autorizacao::baseUrl()) ?>/index.php">Voltar ao início</a></p>
</div></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
