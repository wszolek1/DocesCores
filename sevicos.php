<?php
session_start();

// Verifica se o usuário está logado
$usuarioLogado = isset($_SESSION["usuario_id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css\servicos.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Pacifico&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>

<div class="header">
    <ul>
        <li><a href="inicio.php">Inicio</a></li>
        <li><a href="sevicos.php">Serviços</a></li>
        <li><a href="receitas.php">Receitas</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="carrinho/carrinho.php">Carrinho</a></li>

        <?php if ($usuarioLogado): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</div>

<body>
 
    <div class="fundo">
        <div class="titulo">
            <h1>Serviços da Doces & Cores</h1>  
        </div>

        <div class="linha">
            <div class="imagem">
                <img src="imagens/bakingPag2.jpg" alt="" width="200px" height="200px">
            </div>

            <div class="texto">
                <h2>Consultoria Personalizada de Doces</h2>
                <p>Transforme sua experiência com a 
                    Doces & Cores através de nossas
                    consultorias personalizadas.
                    Nossos especialistas dedicam-se a
                    entender suas preferências e desejos, 
                    proporcionando um 
                    atendimento exclusivo.
                </p>
            </div>
        </div>  

        <div class="linha2">
            
            <div class="texto2">
                <h2>Criações Personalizadas de Confeitaria</h2>
                <p>Mergulhe na arte das criações
                    personalizadas da 
                    Confeitaria Doces & Cores.
                    Nossos confeiteiros transformam
                    suas visões doces em realidade,
                    elaborando delícias sob medida
                    que refletem sua personalidade.
                </p>
            </div>

            <div class="imagem2">
                <img src="imagens/cupcakesPag2.jpg" alt="" width="200px" height="200px">
            </div>
        </div>  

        <div class="linha">
            <div class="imagem">
                <img src="imagens/docesPag2.jpg" alt="" width="200px" height="200px">
            </div>

            <div class="texto">
                <h2>Serviços de Restauração de Sobremesas</h2>
                <p>Confie seus doces mais preciosos aos
                    serviços de restauração da
                    Confeitaria Doces & Cores.
                    seja uma receita clássica ou um favorito
                    de família, nossos talentosos chefs
                    confeiteiros são especializados em
                    restaurar e revitalizar suas sobremesas
                    com meticulosa atenção aos detalhes.
                </p>
            </div>
        </div>  

    </div>

    <div class="rodape">
        <ul>
            <li>
                <span>Contato</span>
                <span class="info"> 55 41 99999-9999</span>
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
