<?php
require "../../src/conexao-bd.php";
require "../../src/Modelo/Pedido.php";
require "../../src/Repositorio/PedidoRepositorio.php";

$repo = new PedidoRepositorio($pdo);
$pedidos = $repo->listarTodos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pedidos</title>

    <link rel="stylesheet" href="../../css/pedidos.css">

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

<div class="container">
    <h2>Gerenciar Pedidos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Qtd</th>
            <th>Status</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($pedidos as $p): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><?= htmlspecialchars($p->getNomeCliente()) ?></td>
                <td><?= htmlspecialchars($p->getProduto()) ?></td>
                <td><?= $p->getQuantidade() ?></td>
                <td><?= htmlspecialchars($p->getStatus()) ?></td>
                <td><?= $p->getDataPedido() ?></td>

                <td class="acoes">
                    <a class="btn-editar" href="editar.php?id=<?= $p->getId() ?>">Editar</a>
                    <a class="btn-excluir" href="excluir.php?id=<?= $p->getId() ?>"
                       onclick="return confirm('Excluir pedido?')">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>

</body>
</html>
