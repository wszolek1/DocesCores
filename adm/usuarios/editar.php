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
    <link rel="stylesheet" href="../../css/usuarios.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2>Editar Usuário</h2>

    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= $user['nome'] ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $user['email'] ?>" required>

        <label>Nova senha (opcional):</label>
        <input type="password" name="senha">

        <label>Tipo:</label>
        <select name="tipo">
            <option value="cliente" <?= $user['tipo'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
            <option value="adm" <?= $user['tipo'] == 'adm' ? 'selected' : '' ?>>Administrador</option>
        </select>

        <button type="submit">Salvar</button>
    </form>

    <a class="voltar" href="index.php">Voltar</a>
</div>

</body>
</html>
