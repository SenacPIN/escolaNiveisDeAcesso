<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('matricula.listar');

require_once "../../classes/matricula.php";

$matricula = new Matricula();

$dados = $matricula->listar();

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<div class="container">

    <div class="card">

        <h2>Lista de Matrículas</h2>

        <?php if (Autorizacao::pode('matricula.cadastrar')): ?><a href="cadastrar.php" class="botao-novo">
            Nova Matrícula
        </a><?php endif; ?>

        <br><br>

        <table border="1">

            <tr>
                <th>ID</th>
                <th>Aluno</th>
                <th>Turma</th>
                <th>Data</th>
                <th>Status</th>
                <?php if (Autorizacao::pode('matricula.editar') || Autorizacao::pode('matricula.excluir')): ?><th>Ações</th><?php endif; ?>
            </tr>

            <?php foreach ($dados as $linha): ?>

                <tr>

                    <td><?= $linha['id_matricula'] ?></td>
                    <td><?= $linha['aluno'] ?></td>
                    <td><?= $linha['nome_turma'] ?></td>
                    <td><?= $linha['data_matricula'] ?></td>
                    <td><?= $linha['status'] ?></td>

                    <?php if (Autorizacao::pode('matricula.editar') || Autorizacao::pode('matricula.excluir')): ?><td>

                        <?php if (Autorizacao::pode('matricula.editar')): ?>
                        <a class="editar"
                            href="editar.php?id=<?= $linha['id_matricula'] ?>">
                            Editar
                        </a>
                        <?php endif; ?>
                        <?php if (Autorizacao::pode('matricula.excluir')): ?>
                        <a class="excluir"
                            href="excluir.php?id=<?= $linha['id_matricula'] ?>"
                            onclick="return confirm('Deseja realmente excluir esta matrícula?')">
                            Excluir
                        </a>
                        <?php endif; ?>
                    </td><?php endif; ?>

                </tr>
    </div>
</div>

<?php endforeach; ?>

</table>

<?php include "../../includes/footer.php"; ?>
