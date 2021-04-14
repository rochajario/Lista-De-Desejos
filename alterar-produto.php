<?php
    session_start();
    $id = $_GET['id'];
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
    <form method="post" enctype="multipart/form-data" action="router.php">
        <fieldset>
            <legend>Alterar Produto</legend>
            <input type='hidden' name='id' value='<?php echo $id; ?>'>
            <table>
                <tr>
                    <th>Nome:</th>
                    <td><input type='text' name='nome' placeholder="Nome"></td>
                </tr>
                <tr>
                    <th>Preço:</th>
                    <td><input type='text' name='preco' placeholder="Preço"></td>
                </tr>
                <tr>
                    <th>Imagem:</th>
                    <td><input type='file' name='arquivo'></td>
                </tr>
                <tr>
                    <td colspan=2><input type="submit" name='alterar-produto' value="Alterar"/></td>
                </tr>
            </table>
        </fieldset>
    </form>
    </main>
</body>
</html>
