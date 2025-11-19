<?php
session_start();
include("conexao.php"); // conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (!empty($email) && !empty($senha)) {

        // Busca o cliente pelo email
        $stmt = $conn->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $cliente = $result->fetch_assoc();

            // Verifica a senha (com hash)
            if (password_verify($senha, $cliente['senha'])) {
                // Guarda dados na sessão
                $_SESSION['usuario_id'] = $cliente['id'];
                $_SESSION['usuario_nome'] = $cliente['nome'];
                $_SESSION['usuario_tipo'] = $cliente['tipo'];

                // Redireciona de acordo com o tipo
                if ($cliente['tipo'] === 'admin') {
                    header("Location: admin_dashboard.php"); // 🔧 coloque aqui a página do admin
                } else {
                    header("Location: pag1.html"); // 🔧 coloque aqui a página do usuário comum
                }
                exit;
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Email não encontrado!";
        }

        $stmt->close();
    } else {
        $erro = "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Doces & Cores</title>
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
        <h1>Login</h1>
        <p>Faça seu Login</p>
    </div>

    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <br>
        <input type="password" name="senha" placeholder="Senha" required>
        <br><br>
        <button type="submit">Entrar</button>
        <br>
        <button type="button"><a href="cadastro.php">Cadastrar-se</a></button>
    </form>

    <?php if (isset($erro)) echo "<p style='color:red; text-align:center;'>$erro</p>"; ?>
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
