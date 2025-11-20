<?php
require "../src/conexao-bd.php";

$id = $_GET['id'] ?? 0;

// Buscar produto com segurança
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    // Troca a imagem?
    if (!empty($_FILES['imagem']['name'])) {

        $nomeArquivo = $_FILES['imagem']['name'];
        $caminhoTemp = $_FILES['imagem']['tmp_name'];

        // Caminho físico correto (editar.php está dentro de /adm/)
        $img = "../upload/" . $nomeArquivo;

        move_uploaded_file($caminhoTemp, $img);

        // Caminho salvo no banco SEM ../
        $imgBanco = "upload/" . $nomeArquivo;

    } else {
        // mantém a imagem antiga
        $imgBanco = $produto['imagem'];
    }

    // Update final (sem categoria)
    $sql = "UPDATE produtos 
            SET nome=?, descricao=?, preco=?, imagem=?
            WHERE id=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $descricao, $preco, $imgBanco, $id]);

    header("Location: index.php");
    exit;
}
?>

<!-- FORM -->
<form method="POST" enctype="multipart/form-data">
    <label>Nome</label><br>
    <input name="nome" value="<?= $produto['nome'] ?>"><br><br>

    <label>Descrição</label><br>
    <textarea name="descricao"><?= $produto['descricao'] ?></textarea><br><br>

    <label>Preço</label><br>
    <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>"><br><br>

    <label>Imagem:</label><br>
    <img src="../<?= $produto['imagem'] ?>" width="120"><br>
    <input type="file" name="imagem"><br>
    <small>Deixe vazio para manter a mesma</small><br><br>

    <button type="submit">Salvar</button>
</form>
