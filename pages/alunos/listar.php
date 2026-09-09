<?php
require_once "../../config/autorizacao.php";
Autorizacao::exigir('aluno.listar');

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../classes/aluno.php";

$aluno = new Aluno();

$dados = $aluno->listar();

include "../../includes/header.php";
include "../../includes/menu.php";

?>

<div class="container">

    <div class="card">

        <h2>Lista de Alunos</h2>

        <?php if (Autorizacao::pode('aluno.cadastrar')): ?><a href="cadastrar.php" class="botao-novo">
            Cadastrar Novo Aluno
        </a><?php endif; ?>


        <br><br>

        <table border="1">

            <tr>

                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <?php if (Autorizacao::pode('aluno.editar') || Autorizacao::pode('aluno.excluir')): ?><th>Ações</th><?php endif; ?>

            </tr>

            <?php foreach ($dados as $linha): ?>

                <tr>

                    <td><?= $linha['id_aluno'] ?></td>
                    <td><?= $linha['nome'] ?></td>
                    <td><?= $linha['cpf'] ?></td>
                    <td><?= $linha['telefone'] ?></td>

                    <?php if (Autorizacao::pode('aluno.editar') || Autorizacao::pode('aluno.excluir')): ?><td>

                        <?php if (Autorizacao::pode('aluno.editar')): ?>
                        <a class="editar"
                            href="editar.php?id=<?= $linha['id_aluno'] ?>">
                            Editar
                        </a>
                        <?php endif; ?>
                        <?php if (Autorizacao::pode('aluno.excluir')): ?>
                        <a class="excluir"
                            href="excluir.php?id=<?= $linha['id_aluno'] ?>"
                            onclick="return confirm('Deseja realmente excluir este aluno?')">
                            Excluir
                        </a>
                        <?php endif; ?>
                    </td><?php endif; ?>

                </tr>

            <?php endforeach; ?>

        </table>
    </div>

    <?php

    include "../../includes/footer.php";

    ?>
