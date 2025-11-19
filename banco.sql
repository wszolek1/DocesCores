-- Cria o banco de dados (se não existir)
CREATE DATABASE IF NOT EXISTS db_DocesCores;
USE db_DocesCores;

-- Tabela de clientes (com campo de tipo de acesso)
CREATE TABLE IF NOT EXISTS clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  tipo ENUM('usuario', 'admin') DEFAULT 'usuario',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  descricao VARCHAR(200) NOT NULL,
  preco DOUBLE NOT NULL
);

-- (Opcional) Inserir um administrador padrão
-- ⚠️ A senha abaixo ("admin123") está com hash seguro do PHP
INSERT INTO clientes (nome, email, senha, tipo) VALUES
('Administrador', 'admin@docescores.com', '$2y$10$VdHXYhQWeUBI2Ixh5H8tHOdHLTqH9oCIFG1ZAgttvY.qjBoV5Q1J.', 'admin');

-- (Opcional) Inserir um usuário comum de exemplo
INSERT INTO clientes (nome, email, senha, tipo) VALUES
('Usuário Teste', 'usuario@docescores.com', '$2y$10$ok0K6p4fQzt8clMzQypqeeDUQcbBSf2V9t0EBMtGCRCTDKyOPZnpK', 'usuario');
