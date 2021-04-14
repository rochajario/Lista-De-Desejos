<?php
    session_start();
    if(!$_SESSION['produtos']){
        header('Location: router.php');
    }
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
        <legend>Produtos Cadastrados</legend>
        <div class=produtos-box>
            <?php
                areaDeTrabalho();
            ?>
        </div>
    </fieldset>
    </main>
</body>
</html>

<?php
function areaDeTrabalho()
{
    if(empty($_SESSION['produtos'])){
        echo "Nenhum Produto Cadastrado";
        return;
    }

    foreach($_SESSION['produtos'] as $produto){
    ?>
        <div>
            <table>
                <tr>
                    <th colspan=2>
                        <img class='img-grande' src='<?php echo $produto['imagem'];?>'/>
                    </th>
                </tr>
                <tr>
                    <td><?php echo $produto['nome'];?></td>
                    <td><?php echo $produto['preco'];?></td>
                </tr>
                <tr>
                    <td colspan=2>
                        <div class='btn-nav'>
                            <div class='btn-nav-add'>
                                <a href='router.php?adicionar-item-carrinho=<?php echo $produto['id']; ?>'>
                                    <i class="fas fa-cart-arrow-down fa-lg" title='Adicionar ao Carrinho'></i>
                                </a>
                            </div>
                            <div class='btn-nav-edit'>
                                <a href='alterar-produto.php?id=<?php echo $produto['id']; ?>'>
                                    <i class="far fa-edit fa-lg" title='Alterar Ítem'></i>
                                </a>
                            </div>
                            <div class='btn-nav-remove'>
                                <a href='router.php?remover-produto=<?php echo $produto['id']; ?>'>
                                    <i class="far fa-trash-alt fa-lg" title='Remover Ítem'></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    }
}