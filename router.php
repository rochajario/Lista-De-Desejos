<?php

require 'vendor/autoload.php';
use rochajario\ListaDeDesejos\model\ArquivadorDeImagens as Arquivador;
use rochajario\ListaDeDesejos\model\Produto;
use rochajario\ListaDeDesejos\model\ProdutoDAO as Dao;
use rochajario\ListaDeDesejos\model\PDOConnector as Pdo;

session_start();
$_SESSION['produtos'];
$_SESSION['carrinho'];

if(empty($_SESSION['produtos'])){
    $_SESSION['produtos'] = atualizaProdutos($dao);
    header('Location: index.php');
}

if(isset($_POST['cadastrar-produto'])){
    novoProduto($dao);
    $_SESSION['produtos'] = atualizaProdutos();
    header('Location: index.php');
}

if(isset($_POST['alterar-produto'])){
    alteraProduto();
    $_SESSION['produtos'] = atualizaProdutos();
    header('Location: index.php');
}

if(isset($_GET['remover-produto'])){
    deletaProduto($_GET['remover-produto']);
    $_SESSION['produtos'] = atualizaProdutos();
    header('Location: index.php');
}

if(isset($_GET['adicionar-item-carrinho'])){
    adicionaAoCarrinho($_GET['adicionar-item-carrinho']);
    header('Location: index.php');
}
if(isset($_GET['remover-item-carrinho'])){
    removeDoCarrinho($_GET['remover-item-carrinho']);
    header('Location: index.php');
}


//Gerencia Carrinho
function adicionaAoCarrinho($itemSelecionado)
{
    $_SESSION['carrinho'][]=procura($itemSelecionado);
}

function removeDoCarrinho($itemSelecionado)
{
    foreach($_SESSION['carrinho'] as $item){
        if($item->getId() == $itemSelecionado){
            unset($item);
        }
    }
}

//Gerencia Área de Exibição
function atualizaProdutos()
{
    $dao = new Dao(Pdo::getConnectionDev());
    return $dao->read();

}

//Gerencia Produtos
function novoProduto()
{
    $dao = new Dao(Pdo::getConnectionDev());
    $arquivador = new Arquivador();
    $arquivador->arquiva($_FILES['arquivo']);
    $enderecoImagem = $arquivador->obtemDestinoArquivo();
    $produto = new Produto($_POST['nome'],$_POST['preco'],$enderecoImagem,$_POST['id']);
    $dao->create($produto);
}

function alteraProduto():void 
{
    $dao = new Dao(Pdo::getConnectionDev());
    $produtoAntigo = procura($_POST['id']);

    if(!isset($_FILES['arquivo'])){
        $produto = new Produto($_POST['nome'],$_POST['preco'],$produtoAntigo['imagem'],$_POST['id']);
        $dao->update($produto);
        return;
    }

    Arquivador::deleta($produtoAntigo->getImagem());
    $arquivador = new Arquivador();
    $arquivador->arquiva($_FILES['arquivo']);
    $enderecoImagem = $arquivador->obtemDestinoArquivo();

    $produto = new Produto($_POST['nome'],$_POST['preco'],$enderecoImagem,$_POST['id']);
    $dao->update($produto);
}

function procura($id): ?Produto
{
    $dao = new Dao(Pdo::getConnectionDev());
    $dados = null;
    $bancoDeDados = $dao->read();
    foreach($bancoDeDados as $produto){
        if($produto['id']==$id){
            $dados = $produto;
        }
    }
    return new Produto($dados['nome'],$dados['preco'],$dados['imagem'],$dados['id']);
}

function deletaProduto($id)
{
    $dao = new Dao(Pdo::getConnectionDev());
    $produtoAntigo = procura($id);
    Arquivador::deleta($produtoAntigo->getImagem());
    $dao->delete($id);
}