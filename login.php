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
        </div>
    </header>
    <main>
        <form method="post" action="router.php">
            <fieldset>
                <legend>Login</legend>
                <table>
                    <tr>
                        <th>Username:</th>
                        <td><input type='text' name='username' placeholder="Digite seu usuário"></td>
                    </tr>
                    <tr>
                        <th>Senha:</th>
                        <td><input type='pasword' name='senha' placeholder="Digite sua Senha"></td>
                    </tr>
                    <tr>
                        <td colspan=2><input type="submit" name='btn-login' value="Login"/></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </main>
</body>
</html>