<?php
session_start();
require "../src/conexao-bd.php";

$id = $_GET['id'] ?? null;

if ($id) {
    // Pega quantidade atual
    $stmt = $pdo->prepare("SELECT quantidade FROM carrinho WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();

    if ($item['quantidade'] > 1) {
        $pdo->prepare("UPDATE carrinho SET quantidade = quantidade - 1 WHERE id = ?")
            ->execute([$id]);
    } else {
        $pdo->prepare("DELETE FROM carrinho WHERE id = ?")
            ->execute([$id]);
    }
}

header("Location: carrinho.php");
exit;
