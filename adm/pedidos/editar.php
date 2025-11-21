<?php
require "../../src/conexao-bd.php";

if (!isset($_GET['id'])) {
    die("ID do pedido não informado.");
}

$id = $_GET['id'];

// busca pedido
$stmt = $pdo->prepare("SELECT * FROM pedidos WHERE id = ?");
$stmt->execute([$id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    die("Pedido não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];

    $update = $pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
    $update->execute([$status, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Pedido</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/pedidos.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

</head>
<body>

<div class="container">
    <h2>Editar Pedido</h2>

    <p><strong>Cliente:</strong> <?= htmlspecialchars($pedido['nome_cliente']) ?></p>
    <p><strong>Produto:</strong> <?= htmlspecialchars($pedido['produto']) ?></p>

    <form method="POST">
        <label>Status:</label>
        <select name="status">
            <option value="Pendente"     <?= $pedido['status']=="Pendente" ? "selected" : "" ?>>Pendente</option>
            <option value="Preparando"   <?= $pedido['status']=="Preparando" ? "selected" : "" ?>>Preparando</option>
            <option value="Enviado"      <?= $pedido['status']=="Enviado" ? "selected" : "" ?>>Enviado</option>
            <option value="Concluído"    <?= $pedido['status']=="Concluído" ? "selected" : "" ?>>Concluído</option>
        </select>

        <button type="submit">Salvar</button>
    </form>

    <a class="voltar" href="index.php">Voltar</a>
</div>

</body>
</html>
