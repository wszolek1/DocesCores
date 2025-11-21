CREATE DATABASE DocesCoresdb
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_general_ci;

USE DocesCoresdb;


CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) DEFAULT 'imagens/default.png'
);


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('adm', 'cliente') DEFAULT 'cliente'
);

-- ADMINISTRADOR
INSERT INTO usuarios (nome, email, senha, tipo)
VALUES (
    'Administrador',
    'admin@docescores.com',
    '$2y$10$skUqnUrW7M8xhLFRnbUMMembsV7YxqcyVst5zpbVCTkEz92.SmOr.',
    'adm'
);


CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);


CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome_cliente VARCHAR(255) NOT NULL,
    produto VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    status ENUM('Pendente','Preparando','Enviado','Concluído') DEFAULT 'Pendente',
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);



INSERT INTO produtos (nome, descricao, preco, imagem) VALUES
('Bolo Red Velvet', 'Delicioso bolo aveludado com cobertura de cream cheese.', 59.90, 'imagens/redvelvet.jpg'),
('Cupcake de Chocolate', 'Massa fofinha com cobertura cremosa de chocolate.', 9.90, 'imagens/cupcake_chocolate.jpg'),
('Macaron Colorido', 'Diversos sabores, crocantes por fora e macios por dentro.', 4.50, 'imagens/macaron.jpg'),
('Torta de Limão', 'Base crocante, recheio azedinho e merengue queimadinho.', 39.90, 'imagens/torta_limao.jpg');
