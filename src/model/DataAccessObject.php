<?php
namespace rochajario\ListaDeDesejos\model;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Persistivel;

abstract class DataAccessObject
{
    protected \PDO $instancia;

    public function __construct(\PDO $instancia)
    { 
        $this->instancia = $instancia;
    }

    abstract function create(Persistivel $objeto):bool;
    abstract function read(?int $id):array;
    abstract function update(Persistivel $objeto):bool;
    abstract function delete(int $id):bool;
}