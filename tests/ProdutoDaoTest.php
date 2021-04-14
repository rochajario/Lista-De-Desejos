<?php
namespace rochajario\ListaDeDesejos\tests;

use PHPUnit\Framework\TestCase;
use rochajario\ListaDeDesejos\model\PDOConnector;
use rochajario\ListaDeDesejos\model\ProdutoDAO;
use rochajario\ListaDeDesejos\model\Produto;

class ProdutoDaoTest extends TestCase
{
    private \PDO $pdo;
    private ProdutoDAO $dao;

    public function setUp():void 
    {
        $this->pdo = PDOConnector::getConnectionDev();
        $this->dao = new ProdutoDAO($this->pdo);
    }

    //Data Providers
    public function produtosValidos():array
    {
        $produto1 = new Produto("Jogo de Xadrez", 100, "imagens/JogoXadrez.jpg", null);
        $produto2 = new Produto("Bola de Basquete", 59.9, "imagens/BolaBasquete.jpg", null);
        return [
            "Produto 1"=>[$produto1],
            "Produto 2"=>[$produto2]
        ];
    }

    public function produtosInvalidos():array
    {
        $produto1 = new Produto(null, null, null, null);
        $produto2 = new Produto(null, null, null, null);
        return [
            "Produto 1"=>[$produto1],
            "Produto 2"=>[$produto2]
        ];
    }

    /**
     * @dataProvider produtosValidos
     */
    public function testDeveriaCadastrarItemValido(Produto $produto):void 
    {
        $this->pdo->beginTransaction();
        self::assertTrue($this->dao->create($produto));
        $this->pdo->rollBack();
    }

    public function testDeveriaRecuperarItemDoBanco():void 
    {
        $dados = $this->dao->read();
        self::assertTrue(is_array($dados));
        self::assertEquals("Cubo Magico",$dados[0]["nome"]);
        self::assertEquals("25",$dados[0]["preco"]);
    }

    public function testDeveriaAtualizarItemDoBanco():void 
    {
        $produto = new Produto("Cubo Magico",25,"imagem.jpg",1);

        $this->pdo->beginTransaction();
        self::assertTrue($this->dao->update($produto));
        $this->pdo->rollBack();
    }
    
    public function testDeveriaDeletarItemDoBanco():void 
    {
        $this->pdo->beginTransaction();
        self::assertTrue($this->dao->delete(2));
        $this->pdo->rollBack();
    }

    /**
     * @dataProvider produtosInvalidos
     */
    
    /*
    
    public function testDeveriaFalharAoCadastrarItemIvalido(Produto $produto):void 
    {
        $this->pdo->beginTransaction();
        self::assertFalse($this->dao->create($produto));
        $this->pdo->rollBack();
    }
    
    */

}