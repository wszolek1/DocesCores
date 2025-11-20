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

// 1) Excluir itens do carrinho desse usuário
$pdo->prepare("DELETE FROM carrinho WHERE usuario_id = ?")->execute([$id]);

// 2) Agora sim excluir o usuário
$pdo->prepare("DELETE FROM usuarios WHERE id = ?")->execute([$id]);

header("Location: index.php");
exit;
?>
