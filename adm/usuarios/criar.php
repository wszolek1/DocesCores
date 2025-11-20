<?php
session_start();
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'adm') {
    header("Location: ../../login.php");
    exit;
}

require "../../src/conexao-bd.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo  = $_POST['tipo'];

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, $senha, $tipo]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Criar Usuário</title>
</head>
<body>

<h2>Criar Usuário</h2>

<form method="post">
    Nome: <br>
    <input type="text" name="nome" required><br><br>

    Email: <br>
    <input type="email" name="email" required><br><br>

    Senha: <br>
    <input type="password" name="senha" required><br><br>

    Tipo:<br>
    <select name="tipo">
        <option value="cliente">Cliente</option>
        <option value="adm">Administrador</option>
    </select><br><br>

    <button type="submit">Cadastrar</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>
