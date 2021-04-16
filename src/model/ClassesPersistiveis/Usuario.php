<?php
namespace rochajario\ListaDeDesejos\model\ClassesPersistiveis;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Persistivel;

class Usuario implements Persistivel
{
    private array $dados;

    public function __construct(string $username,?string $senha, ?int $id)
    {
        $this->dados = ["username","senha","id"];
        $this->dados['username']=$username;
        $this->dados['senha']=$senha;
        $this->dados['id']=$id;
    }

    public function getUsername():string 
    {
        return $this->dados['username'];
    }
    public function getSenha():string 
    {
        return $this->dados['senha'];
    }
    public function getId()
    {
        return $this->dados['id'];
    }
}