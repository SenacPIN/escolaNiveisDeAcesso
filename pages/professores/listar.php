<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('professor.listar');

require_once "../../classes/professor.php";

$professor = new Professor();

$dados = $professor->listar();

include "../../includes/header.php";
include "../../includes/menu.php";

?>
<div class="container">

    <div class="card">

        <h2>Lista de Professores</h2>

        <?php if (Autorizacao::pode('professor.cadastrar')): ?><a href="cadastrar.php" class="botao-novo">
            Cadastrar Novo Professor
        </a><?php endif; ?>

        <br><br>

        <table border="1">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Especialidade</th>
                <?php if (Autorizacao::pode('professor.editar') || Autorizacao::pode('professor.excluir')): ?><th>Ações</th><?php endif; ?>
            </tr>

            <?php foreach ($dados as $linha): ?>

                <tr>

                    <td><?= $linha['id_professor'] ?></td>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['cpf'] ?></td>
                    <td><?= $linha['telefone'] ?></td>
                    <td><?= $linha['especialidade'] ?></td>

                    <?php if (Autorizacao::pode('professor.editar') || Autorizacao::pode('professor.excluir')): ?><td>

                        <?php if (Autorizacao::pode('professor.editar')): ?>
                        <a class="editar"
                            href="editar.php?id=<?= $linha['id_professor'] ?>">
                            Editar
                        </a>
                        <?php endif; ?>
                        <?php if (Autorizacao::pode('professor.excluir')): ?>
                        <a class="excluir"
                            href="excluir.php?id=<?= $linha['id_professor'] ?>"
                            onclick="return confirm('Deseja realmente excluir este professor?')">
                            Excluir
                        </a>
                        <?php endif; ?>
                    </td><?php endif; ?>

                </tr>

            <?php endforeach; ?>

        </table>
    </div>
</div>

<?php

include "../../includes/footer.php";

?>
