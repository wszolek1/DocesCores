<?php
// logout.php
session_start();

// Destrói todas as variáveis de sessão
session_unset();

// Destrói a sessão totalmente
session_destroy();

// Redireciona para a página inicial (ajuste se necessário)
header("Location: login.php");
exit();
