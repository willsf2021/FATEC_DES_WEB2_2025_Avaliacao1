<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();


    $nome_correto;
    $senha_correta;

    $nome_entrada = $_POST['nomeUsuario'];
    $senha_entrada = $_POST['senha'];

    switch ($_POST['tipoUsuario']) {
        case "professor":
            $nome_correto = "professor";
            $senha_correta = "professor";
            break;
        case "bibliotecario":
            $nome_correto = "biblio";
            $senha_correta = "biblio";
            break;
    }

    if ($nome_entrada == $nome_correto && $senha_entrada == $senha_correta) {
        $_SESSION['loggedin'] = true;
        $_SESSION['userName'] = $nome_entrada;

        
        header("Location: dashboard.php");
    } else {
        $_SESSION['loggedin'] = false;
    }
}



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        button,
        input {

            font-family: sans-serif;
        }
    </style>
    <title>Biblioteca Espaço do Saber</title>
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

        <h1>
            Seja bem-vindo!
        </h1>
        <fieldset>
            <h3>
                Selecione o tipo de usuário
            </h3>
            <label for="bibliotecario">
                Bibliotecário
            </label>
            <input type="radio" checked name="tipoUsuario" value="bibliotecario" id="bibliotecario">
            <label for="bibliotecario">
                Professor
            </label>
            <input type="radio" name="tipoUsuario" value="professor" id="professor">
        </fieldset>
        <label for="nomeUsuario">Nome de Usuário:</label>
        <input type="text" id="nomeUsuario" name="nomeUsuario">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha">
        <button type="submit">Entrar</button>
    </form>
</body>

</html>