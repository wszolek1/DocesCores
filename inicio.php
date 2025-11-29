<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/inicio.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

</head>

<div class="header">
    <ul>
        <li><a href="inicio.php">Inicio</a></li>
        <li><a href="sevicos.php">Serviços</a></li>
        <li><a href="receitas.php">Receitas</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="carrinho/carrinho.php">Carrinho</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</div>

<body>
<div class="fundo">
    <div class="doces">
        <h1>Confeitaria Doces & Cores</h1>
    </div>
</div>

<div class="rodape">
    <ul>
        <li>
            <span>Contato</span>
            <span class="info"> 55 41 99999-9999</span>
        </li>
        <li>
            <span>Rua João Negrão</span>
            <span class="info">Curitiba, Paraná</span>
        </li>
        <li>
            <span>Horário de funcionamento</span>
            <span class="info">Seg - Sex, 10:00 - 19:00</span>
        </li>
    </ul>
</div>

</body>
</html>
