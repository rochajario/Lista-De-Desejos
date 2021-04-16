CREATE DATABASE lista_de_desejos CHARACTER SET utf8 COLLATE utf8_general_ci;

USE lista_de_desejos;

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT, 
    username VARCHAR(255) NOT NULL, 
    senha VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(255) NOT NULL, 
    preco VARCHAR(255) NOT NULL, 
    imagem VARCHAR(255), 
    id_usuario INT,
    PRIMARY KEY(id),
    CONSTRAINT FK_ProdutoUsuario FOREIGN KEY (id_usuario) 
    REFERENCES lista_de_desejos.usuarios(id)
);

INSERT INTO usuarios (username,senha) VALUES ("admin","admin");
INSERT INTO produtos (nome,preco,imagem,id_usuario) VALUES ("Cubo Magico", "25", "imagens/CuboMagico.jpg","1");
INSERT INTO produtos (nome,preco,imagem,id_usuario) VALUES ("Livro: Design Patterns", "55.9", "imagens/DesignPatterns.jpg","1");


