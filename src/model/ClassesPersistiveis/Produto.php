<?php
namespace rochajario\ListaDeDesejos\model\ClassesPersistiveis;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Persistivel;

class Produto implements Persistivel
{
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

    public function getIdUsuario()
    {
        return $this->dados['id_usuario'];
    }
    
    public function __construct(string $nome, string $preco, ?string $imagem, ?string $id, ?string $id_usuario)
    {
        $this->dados['nome']=$nome;
        $this->dados['preco']=$preco;
        $this->dados['imagem']=$imagem;
        $this->dados['id']=$id;
        $this->dados['id_usuario']=$id_usuario;
    }

}