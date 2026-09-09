<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('turma.listar');

require_once "../../classes/turma.php";

$turma = new Turma();

$dados = $turma->listar();

include "../../includes/header.php";
include "../../includes/menu.php";

?>
<div class="container">

    <div class="card">

        <h2>Lista de Turmas</h2>

        <?php if (Autorizacao::pode('turma.cadastrar')): ?><a href="cadastrar.php" class="botao-novo">
            Cadastrar Nova Turma
        </a><?php endif; ?>

        <br><br>

        <table border="1">

            <tr>
                <th>ID</th>
                <th>Turma</th>
                <th>Série</th>
                <th>Ano Letivo</th>
                <th>Professor</th>
                <?php if (Autorizacao::pode('turma.editar') || Autorizacao::pode('turma.excluir')): ?><th>Ações</th><?php endif; ?>
            </tr>

            <?php foreach ($dados as $linha): ?>

                <tr>

                    <td><?= $linha['id_turma'] ?></td>
                    <td><?= $linha['nome_turma'] ?></td>
                    <td><?= $linha['serie'] ?></td>
                    <td><?= $linha['ano_letivo'] ?></td>
                    <td><?= $linha['professor'] ?></td>

                    <?php if (Autorizacao::pode('turma.editar') || Autorizacao::pode('turma.excluir')): ?><td>

                        <?php if (Autorizacao::pode('turma.editar')): ?>
                        <a class="editar"
                            href="editar.php?id=<?= $linha['id_turma'] ?>">
                            Editar
                        </a>
                        <?php endif; ?>
                        <?php if (Autorizacao::pode('turma.excluir')): ?>
                        <a class="excluir"
                            href="excluir.php?id=<?= $linha['id_turma'] ?>"
                            onclick="return confirm('Deseja realmente excluir esta turma?')">
                            Excluir
                        </a>
                        <?php endif; ?>
                    </td><?php endif; ?>

                </tr>

            <?php endforeach; ?>

        </table>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>
