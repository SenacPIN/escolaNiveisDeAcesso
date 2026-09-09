<?php
$usuarioLogado = Autorizacao::usuario();
$baseUrl = Autorizacao::baseUrl();
?>
<nav><ul>
    <li><a href="<?= $baseUrl ?>/index.php">Home</a></li>
    <?php if (Autorizacao::pode('aluno.listar')): ?><li><a href="<?= $baseUrl ?>/pages/alunos/listar.php">Alunos</a></li><?php endif; ?>
    <?php if (Autorizacao::pode('professor.listar')): ?><li><a href="<?= $baseUrl ?>/pages/professores/listar.php">Professores</a></li><?php endif; ?>
    <?php if (Autorizacao::pode('turma.listar')): ?><li><a href="<?= $baseUrl ?>/pages/turmas/listar.php">Turmas</a></li><?php endif; ?>
    <?php if (Autorizacao::pode('disciplina.listar')): ?><li><a href="<?= $baseUrl ?>/pages/disciplinas/listar.php">Disciplinas</a></li><?php endif; ?>
    <?php if (Autorizacao::pode('matricula.listar')): ?><li><a href="<?= $baseUrl ?>/pages/matriculas/listar.php">Matrículas</a></li><?php endif; ?>
    <?php if (Autorizacao::pode('consulta.visualizar')): ?><li><a href="<?= $baseUrl ?>/consultas/dashboard.php">Consultas</a></li><?php endif; ?>
    <li class="usuario-menu"><span><?= htmlspecialchars($usuarioLogado['nome']) ?> (<?= htmlspecialchars(ucfirst($usuarioLogado['nivel_acesso'])) ?>)</span></li>
    <li><a href="<?= $baseUrl ?>/logout.php">Sair</a></li>
</ul></nav>
