<?php
namespace rochajario\ListaDeDesejos\model;
use rochajario\ListaDeDesejos\model\Produto;
use rochajario\ListaDeDesejos\model\PDOConnector;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Persistivel;

class ProdutoDAO extends DataAccessObject
{
    public function create(Persistivel $objeto):bool
    {
        $sql = 'INSERT INTO produtos (nome,preco,imagem,id_usuario) VALUES (?,?,?,?);';
        $stmt = $this->instancia->prepare($sql);
        $stmt->bindValue(1, $objeto->getNome());
        $stmt->bindValue(2, $objeto->getPreco());
        $stmt->bindValue(3, $objeto->getImagem());
        $stmt->bindValue(4, $objeto->getIdUsuario());
        $status = $stmt->execute();
        return $status;
        
    }
    
    public function read(?int $id):array
    {
        if($id == null){
            $sql = 'SELECT * FROM produtos;';
            $stmt = $this->instancia->prepare($sql);
        }
        else{
            $sql = 'SELECT * FROM produtos WHERE id_usuario=?;';
            $stmt = $this->instancia->prepare($sql);
            $stmt->bindValue(1,$id);
        }
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function update(Persistivel $objeto):bool
    {
        $sql = 'UPDATE produtos SET nome=?,preco=?,imagem=? WHERE id=?;';
        $stmt = $this->instancia->prepare($sql);
        $stmt->bindValue(1,$objeto->getNome());
        $stmt->bindValue(2,$objeto->getPreco());
        $stmt->bindValue(3,$objeto->getImagem());
        $stmt->bindValue(4,$objeto->getId());
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