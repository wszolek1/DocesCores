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

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Usuário não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $tipo  = $_POST['tipo'];

    // Se enviar senha nova
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $pdo->prepare("UPDATE usuarios SET nome=?, email=?, senha=?, tipo=? WHERE id=?")
            ->execute([$nome, $email, $senha, $tipo, $id]);
    } else {
        $pdo->prepare("UPDATE usuarios SET nome=?, email=?, tipo=? WHERE id=?")
            ->execute([$nome, $email, $tipo, $id]);
    }

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Usuário</title>
</head>
<body>

<h2>Editar Usuário</h2>

<form method="post">
    Nome: <br>
    <input type="text" name="nome" value="<?= $user['nome'] ?>" required><br><br>

    Email: <br>
    <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>

    Nova senha (opcional): <br>
    <input type="password" name="senha"><br><br>

    Tipo:<br>
    <select name="tipo">
        <option value="cliente" <?= $user['tipo'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
        <option value="adm"     <?= $user['tipo'] == 'adm' ? 'selected' : '' ?>>Administrador</option>
    </select><br><br>

    <button type="submit">Salvar</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>
