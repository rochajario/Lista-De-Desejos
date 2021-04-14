CREATE DATABASE lista_de_desejos CHARACTER SET utf8 COLLATE utf8_general_ci;

USE lista_de_desejos;

CREATE TABLE produtos (
    id INT NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(255) NOT NULL, 
    preco VARCHAR(255) NOT NULL, 
    imagem VARCHAR(255), 
    PRIMARY KEY(id)
);

INSERT INTO produtos (nome,preco,imagem) VALUES ("Cubo Magico", "25", "imagens/Cubo_Magico.jpg");
INSERT INTO produtos (nome,preco,imagem) VALUES ("Livro: Design Patterns", "55.9", "imagens/Design_Patterns.jpg");


