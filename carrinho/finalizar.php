<?php
session_start();
require "../src/conexao-bd.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// pega nome do cliente
$stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
$nome_cliente = $usuario['nome'] ?? "Cliente";

// pega itens do carrinho
$stmt = $pdo->prepare("
    SELECT c.quantidade, p.nome
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

// salva os pedidos
foreach ($itens as $item) {

    $stmtInsert = $pdo->prepare("
        INSERT INTO pedidos (usuario_id, nome_cliente, produto, quantidade, status)
        VALUES (?, ?, ?, ?, 'Pendente')
    ");

    $stmtInsert->execute([
        $usuario_id,
        $nome_cliente,
        $item['nome'],
        $item['quantidade']
    ]);
}

// limpa carrinho
$pdo->prepare("DELETE FROM carrinho WHERE usuario_id = ?")->execute([$usuario_id]);

echo "<script>
alert('Pedido realizado com sucesso!');
window.location.href = '../pag1.html';
</script>";
