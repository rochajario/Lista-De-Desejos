<?php
namespace rochajario\ListaDeDesejos\model;

class Produto {
    private array $dados;
     
    public function getNome():string
    {
        return $this->dados['nome'];
    }

    public function getPreco()
    {
        return $this->dados['preco'];
    }
    
    public function getImagem()
    {
        return $this->dados['imagem'];
    }

    public function getId()
    {
        return $this->dados['id'];
    }
    
    public function __construct(string $nome, string $preco, ?string $imagem, ?string $id)
    {
        $this->dados['nome']=$nome;
        $this->dados['preco']=$preco;
        $this->dados['imagem']=$imagem;
        $this->dados['id']=$id;
    }

}