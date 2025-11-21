<?php
session_start();

require "src/conexao-bd.php";

if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'adm') {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="css/painel-admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>

<div class="pa-fundo">
    <h1 class="pa-titulo">Painel Administrativo</h1>

    <div class="pa-opcoes">
        <a href="adm/produtos/index.php" class="pa-botao">Gerenciar Produtos</a>
        <a href="adm/usuarios/index.php" class="pa-botao">Gerenciar Usuários</a>
        <a href="adm/pedidos/index.php" class="pa-botao">Gerenciar Pedidos</a>
    </div>
</div>

</body>
</html>
