<?php
session_start();

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'adm') {
    header("Location: ../../login.php");
    exit;
}

require "../../src/conexao-bd.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

try {

    // Excluir itens do carrinho
    $pdo->prepare("DELETE FROM carrinho WHERE usuario_id = ?")->execute([$id]);

    // Tentar excluir o usuário
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php?sucesso=1");
    exit;

} catch (PDOException $e) {

    // Se deu erro de foreign key (usuário tem pedidos), manda aviso
    header("Location: index.php?erro=fk");
    exit;
}
