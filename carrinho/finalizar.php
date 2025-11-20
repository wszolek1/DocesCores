<?php
session_start();
require "../src/conexao-bd.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Pega itens do carrinho
$stmt = $pdo->prepare("
    SELECT c.quantidade, p.preco
    FROM carrinho c
    JOIN produtos p ON c.produto_id = p.id
    WHERE c.usuario_id = ?
");
$stmt->execute([$usuario_id]);
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$itens) {
    echo "<script>alert('Seu carrinho está vazio!'); window.location.href='carrinho.php';</script>";
    exit;
}

// Calcula total
$total = 0;
foreach ($itens as $item) {
    $total += $item['preco'] * $item['quantidade'];
}

// Cria pedido
$stmt = $pdo->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)");
$stmt->execute([$usuario_id, $total]);

// Limpa carrinho
$pdo->prepare("DELETE FROM carrinho WHERE usuario_id = ?")->execute([$usuario_id]);

echo "<script>
alert('Pedido realizado com sucesso!');
window.location.href = '../pag1.html';
</script>";
