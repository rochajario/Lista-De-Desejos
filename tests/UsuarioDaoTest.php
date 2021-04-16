<?php
namespace rochajario\ListaDeDesejos\tests;

use PHPUnit\Framework\TestCase;
use rochajario\ListaDeDesejos\model\PDOConnector;
use rochajario\ListaDeDesejos\model\UsuarioDAO;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Usuario;

class UsuarioDaoTest extends TestCase
{
    private \PDO $pdo;
    private UsuarioDAO $dao;

    public function setUp():void 
    {
        $this->pdo = PDOConnector::getConnectionDev();
        $this->dao = new UsuarioDAO($this->pdo);
    }

    //Data Provider
    public function usuariosValidos():array
    {
        $usuario1 = new Usuario("Jario", "teste", 2);
        $usuario2 = new Usuario("Fernanda", "teste2paraTestar", 3);
        return [
            "Usuario 1"=>[$usuario1],
            "Usuario 2"=>[$usuario2]
        ];
    }

    /**
     * @dataProvider usuariosValidos
     */
    public function testDeveriaCadastrarUsuarioValido(Usuario $usuario):void 
    {
        $this->pdo->beginTransaction();
        self::assertTrue($this->dao->create($usuario));
        $this->pdo->rollBack();
    }

    public function testDeveriaRecuperarUsuarioDoBanco():void 
    {
        $dados = $this->dao->read(null);
        self::assertTrue(is_array($dados));
        self::assertEquals("admin",$dados[0]["username"]);
        self::assertEquals("admin",$dados[0]["senha"]);
    }

    public function testDeveriaAtualizarUsuarioDoBanco():void 
    {
        $usuario = new Usuario("admin","teste",1);

        $this->pdo->beginTransaction();
        self::assertTrue($this->dao->update($usuario));
        $this->pdo->rollBack();
    }
    
    public function testDeveriaDeletarUsuarioDoBanco():void 
    {
        $this->pdo->beginTransaction();
        self::assertTrue($this->dao->delete(1));
        $this->pdo->rollBack();
    }
}
