<?php
namespace rochajario\ListaDeDesejos\model;
use rochajario\ListaDeDesejos\model\Produto;
use rochajario\ListaDeDesejos\model\PDOConnector;

class ProdutoDAO
{
    private \PDO $instancia;

    public function __construct(\PDO $instancia)
    {
        $this->instancia = $instancia;
    }   

    public function create(Produto $produto):bool
    {
        $sql = 'INSERT INTO produtos (nome,preco,imagem) VALUES (?,?,?);';
        $stmt = $this->instancia->prepare($sql);
        $stmt->bindValue(1, $produto->getNome());
        $stmt->bindValue(2, $produto->getPreco());
        $stmt->bindValue(3, $produto->getImagem());
        $status = $stmt->execute();
        return $status;
        
    }
    
    public function read():array
    {
        $sql = 'SELECT * FROM produtos;';
        $stmt = $this->instancia->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function update(Produto $produto):bool
    {
        $sql = 'UPDATE produtos SET nome=?,preco=?,imagem=? WHERE id=?;';
        $stmt = $this->instancia->prepare($sql);
        $stmt->bindValue(1,$produto->getNome());
        $stmt->bindValue(2,$produto->getPreco());
        $stmt->bindValue(3,$produto->getImagem());
        $stmt->bindValue(4,$produto->getId());
        $status = $stmt->execute();
        return $status;
    }
    public function delete(int $id):bool
    {
        $sql = 'DELETE FROM produtos WHERE id=?;';
        $stmt = $this->instancia->prepare($sql);
        $stmt->bindValue(1,$id);        
        $status = $stmt->execute();
        return $status;
    }
}