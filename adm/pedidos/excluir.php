<?php
require "../../src/conexao-bd.php";

if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
