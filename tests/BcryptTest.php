<?php

namespace rochajario\ListaDeDesejos\tests;
use PHPUnit\Framework\TestCase;
use rochajario\ListaDeDesejos\model\Bcrypt;

class BcryptTest extends TestCase
{    
    public function testBcryptDeveriaValidarEntrada()
    {
        $hash = Bcrypt::encrypt("admin");
        $status = Bcrypt::validate("admin", $hash);
        $this->assertEquals(true, $status);
    }

    /*public function testBcryptDeveriaValidarComparacaoDeSaida()
    {
        self::assertTrue(Bcrypt::validate("admin",'FR$2a$08$f0292d90da443a96ecdc9uUQQbsdTrg74fXvNyPy0QDagaZ1Isj.O'));
    }*/
}