<?php
require "../src/conexao-bd.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Caminho final da imagem
    $destino = "../upload/padrao.png";

    // Se o usuário enviar uma imagem, faz upload
    if (!empty($_FILES["imagem"]["name"])) {
        $nomeArquivo = $_FILES["imagem"]["name"];
        $caminhoTemp = $_FILES["imagem"]["tmp_name"];
        $destino = "../upload/" . $nomeArquivo;

        move_uploaded_file($caminhoTemp, $destino);
    }

    // INSERT no banco (sem categoria)
    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) 
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $destino
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>

<h2>Cadastrar novo produto</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao" required></textarea><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco" required><br><br>

    <label>Imagem:</label><br>
    <input type="file" name="imagem"><br><br>

    <button type="submit">Cadastrar</button>
</form>

</body>
</html>
