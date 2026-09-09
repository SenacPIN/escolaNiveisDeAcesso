<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('disciplina.listar');

require_once "../../classes/disciplina.php";

$disciplina = new Disciplina();

$dados = $disciplina->listar();

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<div class="container">

    <div class="card">
        <h2>Lista de Disciplinas</h2>

        <?php if (Autorizacao::pode('disciplina.cadastrar')): ?><a href="cadastrar.php" class="botao-novo">
            Cadastrar Nova Disciplina
        </a><?php endif; ?>

        <br><br>

        <table border="1">

            <tr>
                <th>ID</th>
                <th>Disciplina</th>
                <th>Carga Horária</th>
                <th>Professor</th>
                <?php if (Autorizacao::pode('disciplina.editar') || Autorizacao::pode('disciplina.excluir')): ?><th>Ações</th><?php endif; ?>
            </tr>

            <?php foreach ($dados as $linha): ?>

                <tr>

                    <td><?= $linha['id_disciplina'] ?></td>
                    <td><?= $linha['nome_disciplina'] ?></td>
                    <td><?= $linha['carga_horaria'] ?></td>
                    <td><?= $linha['professor'] ?></td>

                    <?php if (Autorizacao::pode('disciplina.editar') || Autorizacao::pode('disciplina.excluir')): ?><td>

                        <?php if (Autorizacao::pode('disciplina.editar')): ?>
                        <a class="editar"
                            href="editar.php?id=<?= $linha['id_disciplina'] ?>">
                            Editar
                        </a>
                        <?php endif; ?>
                        <?php if (Autorizacao::pode('disciplina.excluir')): ?>
                        <a class="excluir"
                            href="excluir.php?id=<?= $linha['id_disciplina'] ?>"
                            onclick="return confirm('Deseja realmente excluir esta disciplina?')">
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
