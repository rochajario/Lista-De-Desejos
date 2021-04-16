<?php
namespace rochajario\ListaDeDesejos\model;
use rochajario\ListaDeDesejos\model\Usuario;
use rochajario\ListaDeDesejos\model\PDOConnector;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Persistivel;

class UsuarioDAO extends DataAccessObject
{
    public function create(Persistivel $objeto):bool
    {
        $sql = 'INSERT INTO usuarios (username,senha) VALUES (?,?);';
        $stmt = $this->instancia->prepare($sql);
        $stmt->bindValue(1, $objeto->getUsername());
        $stmt->bindValue(2, $objeto->getSenha());
        $status = $stmt->execute();
        return $status;
        
    }
    
    public function read(?int $id):array
    {
        $sql = 'SELECT * FROM usuarios;';
        $stmt = $this->instancia->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function update(Persistivel $objeto):bool
    {
        $sql = 'UPDATE usuarios SET username=?,senha=? WHERE id=?;';
        $stmt = $this->instancia->prepare($sql);
        $stmt->bindValue(1,$objeto->getUsername());
        $stmt->bindValue(2,$objeto->getSenha());
        $stmt->bindValue(3,$objeto->getId());
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