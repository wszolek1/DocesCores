<?php
session_start();
require "../src/conexao-bd.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$produto_id = $_POST['id'] ?? null;

if (!$produto_id) {
    header("Location: ../pag1.html");
    exit;
}

// Verifica se o produto já está no carrinho
$stmt = $pdo->prepare("SELECT id FROM carrinho WHERE usuario_id = ? AND produto_id = ?");
$stmt->execute([$usuario_id, $produto_id]);
$item = $stmt->fetch();

if ($item) {
    // Aumenta quantidade
    $pdo->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id = ?")
        ->execute([$item["id"]]);
} else {
    // Adiciona novo produto
    $pdo->prepare("INSERT INTO carrinho (usuario_id, produto_id, quantidade) 
                    VALUES (?, ?, 1)")
        ->execute([$usuario_id, $produto_id]);
}

header("Location: ../carrinho/carrinho.php");
exit;
