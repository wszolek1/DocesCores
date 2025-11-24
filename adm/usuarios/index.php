<?php
session_start();

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'adm') {
    header("Location: ../../login.php");
    exit;
}

require "../../src/conexao-bd.php";
require "../../src/modelo/Usuario.php";
require "../../src/repositorio/UsuarioRepositorio.php";

$usuarioRepo = new UsuarioRepositorio($pdo);
$usuarios = $usuarioRepo->listarTodos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - Usuários</title>
    <link rel="stylesheet" href="../../css/admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>

<div class="header">
    <ul>
        <li><a href="../../pag1.html">Inicio</a></li>
        <li><a href="../../pag2.html">Serviços</a></li>
        <li><a href="../../pag3.php">Receitas</a></li>
        <li><a href="../../pag4.html">Sobre</a></li>
        <li><a href="../../login.php">Login</a></li>
    </ul>
</div>

<div class="fundo">

    <div class="titulo">
        <h1>Gerenciar Usuários</h1>
    </div>

    <?php if (isset($_GET['erro']) && $_GET['erro'] === 'fk'): ?>
        <p style="color: #ffb3b3; font-size: 20px; text-align: center;">
            ❌ Este usuário possui pedidos e não pode ser excluído.
        </p>
    <?php endif; ?>

    <?php if (isset($_GET['sucesso'])): ?>
        <p style="color: #b3ffb3; font-size: 20px; text-align: center;">
            ✔️ Usuário excluído com sucesso.
        </p>
    <?php endif; ?>

    <div class="topo-admin">
        <a class="btn-criar" href="criar.php">➕ Cadastrar usuário</a>
    </div>

    <table class="tabela">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u->getId() ?></td>
                <td><?= $u->getNome() ?></td>
                <td><?= $u->getEmail() ?></td>
                <td><?= $u->getTipo() ?></td>
                <td>
                    <a class="editar" href="editar.php?id=<?= $u->getId() ?>">Editar</a> |
                    <a class="excluir" href="excluir.php?id=<?= $u->getId() ?>"
                       onclick="return confirm('Excluir este usuário?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

</body>
</html>
