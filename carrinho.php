<?php
    require 'vendor/autoload.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Desejos</title>
    <link rel="stylesheet" href="view/estilo.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class='cabecalho'>
            <div>
                <a href='index.php' title='Página Inicial'>
                    <h1>Lista de Desejos</h1>
                </a>
            </div>
            <div class='nav'>
                <div>
                    <a href='novo-produto.html'>
                        <i class="fas fa-plus-circle fa-lg" title='Adicionar Ítem a Lista'></i>
                    </a>
                </div>
                <div>
                    <a href='carrinho.php'>
                        <i class="fas fa-shopping-cart fa-lg" title='Carrinho'></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <fieldset class='produtos'>
            <legend>Carrinho</legend>
            <div class='produtos-box'>
                <?php
                    exibeCarrinho();
                ?>
            </div>
        </fieldset>
    </main>
</body>
</html>


<!--Se carrinho estiver vazio informa, senão constroi carrinho-->
<?php
function exibeCarrinho()
{
    if(empty($_SESSION['carrinho'])){
        echo "Carrinho Vazio";
        return;
    }
?>
<table>
    <thead>
        <th>Nome</th>
        <th>Imagem</th>
        <th>Preço</th>
        <th>Remover</th>
    </thead>
    <tbody>
<?php
foreach($_SESSION['carrinho'] as $item){
?>
    <tr>
        <td>
            <img class="img-pequena" src="<?php echo $item->getImagem(); ?>">
        </td>
        <td>
            <?php echo $item->getNome(); ?>
        </td>
        <td>
            <?php echo $item->getPreco(); ?>
        </td>
        <td>
            <a href="router.php?remover-item-carrinho=<?php echo $item->getId(); ?>" title="Remover do Carrinho">X</a>
        </td>
    </tr>
<?php
}
?>
</tbody>
</table>
<?php
}
?>