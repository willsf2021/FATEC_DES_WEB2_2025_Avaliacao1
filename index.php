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
        $_SESSION['tipoUsuario'] = $_POST['tipoUsuario'];

        header("Location: login.php");
        exit;
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
    <title>Biblioteca Espaço do Saber</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2 class="text-center mb-3">Seja bem-vindo!</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset class="mb-3">
                <h5>Selecione o tipo de usuário:</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" checked name="tipoUsuario" value="bibliotecario" id="bibliotecario">
                    <label class="form-check-label" for="bibliotecario">📚 Bibliotecário</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipoUsuario" value="professor" id="professor">
                    <label class="form-check-label" for="professor">👨‍🏫 Professor</label>
                </div>
            </fieldset>
            <div class="mb-3">
                <label for="nomeUsuario" class="form-label">Nome de Usuário:</label>
                <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha">
            </div>
            <button type="submit" class="btn btn-custom w-100">Entrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
