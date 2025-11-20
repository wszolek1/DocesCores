<?php
require "src/conexao-bd.php"; // caminho correto da conexão

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (!empty($nome) && !empty($email) && !empty($senha)) {

        // Hash da senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Tipo padrão do usuário
        $tipo = "cliente";

        // Prepara o INSERT corretamente para a tabela usuarios
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nome, email, senha, tipo) 
            VALUES (?, ?, ?, ?)
        ");

        try {
            if ($stmt->execute([$nome, $email, $senhaHash, $tipo])) {
                echo "<script>
                        alert('Cadastro realizado com sucesso!');
                        window.location.href = 'login.php';
                      </script>";
            } else {
                echo "<script>alert('Erro ao cadastrar. Tente novamente.');</script>";
            }

        } catch (PDOException $e) {

            // 1062 → email duplicado
            if ($e->errorInfo[1] == 1062) {
                echo "<script>alert('Este email já está cadastrado!');</script>";
            } else {
                echo "<script>alert('Erro no servidor.');</script>";
            }
        }

    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
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
        <li><a href="pag3.php">Receitas</a></li>
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
        <input type="text" name="nome" placeholder="Nome completo" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="senha" placeholder="Senha" required><br><br>

        <button type="submit">Cadastrar-se</button><br><br>

        <button type="button">
            <a href="login.php">Já tenho conta</a>
        </button>
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
            <span>Horário de funcionamento</span>
            <span class="info">Seg - Sex, 10:00 - 19:00</span>
        </li>
    </ul>
</div>

</body>
</html>
