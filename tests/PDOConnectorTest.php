<?php
namespace rochajario\ListaDeDesejos\tests;
use PHPUnit\Framework\TestCase;
use rochajario\ListaDeDesejos\model\PDOConnector;

class PDOConnectorTest extends TestCase
{
    public function testDeveriaValidarInstanciaDeBancoDeTeste()
    {
        self::assertTrue(PDOConnector::getConnectionDev() instanceof \PDO);
    }
    public function testDeveriaValidarInstanciaDeBancoDeProducao()
    {
        self::assertTrue(PDOConnector::getConnectionPrd() instanceof \PDO);
    }
}
