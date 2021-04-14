<?php
namespace rochajario\ListaDeDesejos\model;

class PDOConnector
{
    private static $producao;
    private static $desenvolvimento;

    public static function getConnectionPrd(){
        if (!isset(self::$producao)):
            self::$producao = new \PDO('mysql:host=us-cdbr-east-03.cleardb.com;dbname=heroku_046758d71938067','b5b821a31dc780','f2e2557c');
        endif;
        return self::$producao;
    }

    public static function getConnectionDev(){
        if (!isset(self::$desenvolvimento)):
            self::$desenvolvimento = new \PDO('mysql:host=localhost;dbname=lista_de_desejos','root','');
        endif;
        return self::$desenvolvimento;
    }
}