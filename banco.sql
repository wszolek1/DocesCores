CREATE DATABASE DocesCoresdb
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_general_ci;

USE DocesCoresdb;

-- ------------------------------
-- TABELA DE PRODUTOS
-- ------------------------------
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) DEFAULT 'imagens/default.png'
);

-- ------------------------------
-- TABELA DE USUÁRIOS
-- ------------------------------
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('adm', 'cliente') DEFAULT 'cliente'
);

-- ADMINISTRADOR COM PASSWORD_HASH (substitua o hash abaixo)
INSERT INTO usuarios (nome, email, senha, tipo)
VALUES (
    'Administrador',
    'admin@docescores.com',
    '$2y$10$skUqnUrW7M8xhLFRnbUMMembsV7YxqcyVst5zpbVCTkEz92.SmOr.',
    'adm'
);

-- ------------------------------
-- TABELA DO CARRINHO
-- ------------------------------
CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- ------------------------------
-- TABELA DE PEDIDOS
-- ------------------------------
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente','pago','enviado','entregue') DEFAULT 'pendente',

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- ------------------------------
-- PRODUTOS PADRÃO
-- ------------------------------
INSERT INTO produtos (nome, descricao, preco, imagem) VALUES
('Bolo Red Velvet', 'Delicioso bolo aveludado com cobertura de cream cheese.', 59.90, 'imagens/redvelvet.jpg'),
('Cupcake de Chocolate', 'Massa fofinha com cobertura cremosa de chocolate.', 9.90, 'imagens/cupcake_chocolate.jpg'),
('Macaron Colorido', 'Diversos sabores, crocantes por fora e macios por dentro.', 4.50, 'imagens/macaron.jpg'),
('Torta de Limão', 'Base crocante, recheio azedinho e merengue queimadinho.', 39.90, 'imagens/torta_limao.jpg');
