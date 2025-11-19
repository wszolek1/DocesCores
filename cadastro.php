<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Validações simples
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Criptografa a senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $tipo = 'usuario'; // tipo padrão

        // Prepara a inserção segura
        $stmt = $conn->prepare("INSERT INTO clientes (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senhaHash, $tipo);

        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso! Faça login para continuar.'); 
                  window.location.href='login.php';</script>";
        } else {
            if ($conn->errno === 1062) { // erro de duplicidade de email
                echo "<script>alert('Este email já está cadastrado!');</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar. Tente novamente.');</script>";
            }
        }

        $stmt->close();
    } else {
        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Doces & Cores</title>
    <link rel="stylesheet" href="css/pag5.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>
<div class="header">
    <ul>
        <li><a href="pag1.html">Inicio</a></li>
        <li><a href="pag2.html">Serviços</a></li>
        <li><a href="pag3.html">Receitas</a></li>
        <li><a href="pag4.html">Sobre</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</div>

<div class="fundo">
    <div class="titulo">
        <h1>Cadastro</h1>
        <p>Crie sua conta para acessar o sistema</p>
    </div>

    <form action="cadastro.php" method="POST">
        <input type="text" name="nome" placeholder="Nome completo" required>
        <br><br>
        <input type="email" name="email" placeholder="Email" required>
        <br><br>
        <input type="password" name="senha" placeholder="Senha" required>
        <br><br>
        <button type="submit">Cadastrar-se</button>
        <br><br>
        <button type="button"><a href="login.php">Já tenho conta</a></button>
    </form>
</div>

<div class="rodape">
    <ul>
        <li>
            <span>Contato</span>
            <span class="info">55 41 99999-9999</span>
        </li>
        <li>
            <span>Rua João Negrão</span>
            <span class="info">Curitiba, Paraná</span>
        </li>
        <li>
