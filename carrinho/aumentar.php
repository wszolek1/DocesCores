<?php
session_start();
require "../src/conexao-bd.php";

$id = $_GET['id'] ?? null;

if ($id) {
    $pdo->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE id = ?")
        ->execute([$id]);
}

header("Location: carrinho.php");
exit;
