<?php
session_start();
require "../src/conexao-bd.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $pdo->prepare("DELETE FROM carrinho WHERE id = ?")->execute([$id]);
}

header("Location: carrinho.php");
exit;
