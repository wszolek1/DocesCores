<?php
require "../../src/conexao-bd.php";

// pega todos os pedidos
$stmt = $pdo->query("SELECT * FROM pedidos ORDER BY data_pedido DESC");
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedidos - Admin</title>

    <link rel="stylesheet" href="../../css/pedidos.css">
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
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['nome_cliente']) ?></td>
                <td><?= htmlspecialchars($p['produto']) ?></td>
                <td><?= $p['quantidade'] ?></td>
                <td><?= htmlspecialchars($p['status']) ?></td>
                <td><?= $p['data_pedido'] ?></td>
                <td class="acoes">
                    <a class="btn-editar" href="editar.php?id=<?= $p['id'] ?>">Editar</a>
                    <a class="btn-excluir" href="excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Excluir pedido?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>

</body>
</html>
