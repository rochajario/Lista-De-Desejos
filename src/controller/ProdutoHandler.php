<?php
namespace rochajario\ListaDeDesejos\controller;

use rochajario\ListaDeDesejos\model\ArquivadorDeImagens as Arquivador;
use rochajario\ListaDeDesejos\model\Produto;
use rochajario\ListaDeDesejos\model\ProdutoDAO as Dao;
use rochajario\ListaDeDesejos\model\PDOConnector as Pdo;

class ProdutoHandler
{
    private $dao;
    private $arquivador;
    
    public function __construct(PDOConnector $pdo)
    {
        $this->$dao = new Dao($pdo);
        $this->arquivador = new Arquivador();
    }
    public function procura($id): ?Produto
    {
        $dados = null;
        $bancoDeDados = $this->dao->read();
        foreach($bancoDeDados as $produto){
            if($produto['id']==$id){
                $dados = $produto;
            }
        }
        return new Produto($dados['nome'],$dados['preco'],$dados['imagem'],$dados['id']);
    }
    public function deleta(array $input)
    {

    }
}