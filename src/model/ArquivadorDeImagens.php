<?php
namespace rochajario\ListaDeDesejos\model;

class ArquivadorDeImagens
{
    private ?string $destinoArquivo;

    public function __construct()
    {
        $this->destinoArquivo = null;
    }

    public function arquiva(array $arquivo):void
    {
        $destino = 'imagens/' . $arquivo['name'];
        $arquivo_tmp = $arquivo['tmp_name'];
        move_uploaded_file($arquivo_tmp, $destino);
        $this->destinoArquivo = $destino;
    }
    public static function deleta(?string $arquivo)
    {
        unlink($arquivo);
    }

    public function obtemDestinoArquivo():?string 
    {
        return $this->destinoArquivo;
    }
}