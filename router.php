<?php

require 'vendor/autoload.php';
use rochajario\ListaDeDesejos\model\ArquivadorDeImagens as Arquivador;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Produto;
use rochajario\ListaDeDesejos\model\ClassesPersistiveis\Usuario;
use rochajario\ListaDeDesejos\model\ProdutoDAO;
use rochajario\ListaDeDesejos\model\UsuarioDAO;
use rochajario\ListaDeDesejos\model\PDOConnector as Pdo;

session_start();
$_SESSION['usuario'];

if (empty($_SESSION['usuario'])){
    header("Location: login.php");
}

if(isset($_POST['btn-login'])){
    
    $formulario = obtemDadosDeLogin();
    $acesso = loginUsuario($formulario);
    
    if (!$acesso['status']){
        header("Location: login.php");
    }

    $_SESSION['usuario'] = $acesso['dados'];
    $_SESSION['produtos'] = atualizaProdutos($_SESSION['usuario']);
    $_SESSION['carrinho'];
    
    header("Location: produtos.php");
}

if(empty($_SESSION['produtos'])){
    $_SESSION['produtos'] = atualizaProdutos($_SESSION['usuario']);
    header('Location: produtos.php');
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
    $_SESSION['carrinho'][]=procuraProduto($itemSelecionado);
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
function atualizaProdutos(Usuario $usuario)
{
    $dao = new ProdutoDao(Pdo::getConnectionDev());
    return $dao->read($usuario->getId());

}

//Gerencia Produtos
function novoProduto()
{
    $dao = new ProdutoDao(Pdo::getConnectionDev());
    $arquivador = new Arquivador();
    $arquivador->arquiva($_FILES['arquivo']);
    $enderecoImagem = $arquivador->obtemDestinoArquivo();
    $produto = new Produto($_POST['nome'],$_POST['preco'],$enderecoImagem,$_POST['id']);
    $dao->create($produto);
}

function alteraProduto():void 
{
    $dao = new ProdutoDao(Pdo::getConnectionDev());
    $produtoAntigo = procuraProduto($_POST['id']);

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

function procuraProduto($id): ?Produto
{
    $dao = new ProdutoDao(Pdo::getConnectionDev());
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
    $dao = new ProdutoDao(Pdo::getConnectionDev());
    $produtoAntigo = procuraProduto($id);
    Arquivador::deleta($produtoAntigo->getImagem());
    $dao->delete($id);
}

function loginUsuario(array $formulario):array
{
    $dao = new UsuarioDao(Pdo::getConnectionDev());
    $acesso = ['status','dados'];
    $acesso["status"]=false;

    $bancoDeDados = $dao->read(null);
    foreach($bancoDeDados as $usuario){
        if($usuario['username'] === $formulario['username']){
            if($usuario['senha'] === $formulario['senha']){
                $acesso['status']=true;
                $acesso['dados']=new Usuario($usuario['username'],null,$usuario['id']);
            }
        }
    }
    return $acesso;
}

function obtemDadosDeLogin():array
{
    $forumario = ['username','senha'];
    $formulario["username"]=$_POST['username'];
    $formulario['senha']=$_POST['senha'];
    return $formulario;
}