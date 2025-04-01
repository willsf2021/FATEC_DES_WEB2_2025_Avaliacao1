<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) && $_SESSION['tipoUsuario'] == "bibliotecario") {

    if (!empty($_POST['tituloLivro']) && !empty($_POST['autor']) && !empty($_POST['editora']) && !empty($_POST['isbn'])) {
        $filename = "livros.txt";
        $handle = fopen($filename, file_exists($filename) ? "a" : "w");

        $conteudo = [
            "Nome do Livro" => $_POST['tituloLivro'],
            "Autor" => $_POST['autor'],
            "Editora" => $_POST['editora'],
            "ISBN" => $_POST['isbn'],
        ];

        $linha = "";
        foreach ($conteudo as $chave => $valor) {
            $linha .= "$chave: $valor | ";
        }

        $linha = rtrim($linha, " | ") . PHP_EOL;
        fwrite($handle, $linha);
        fflush($handle);
        fclose($handle);

        $mensagem = "Livro cadastrado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            margin-top: 32px;
        }

        .btn-logout:hover {
            background-color: #bb2d3b;
        }

        body {
            background: url('../assets/bg.jpg');
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card p-4">
            <h2 class="text-center mb-4">Cadastro de Livros</h2>

            <?php if (isset($mensagem)) : ?>
                <div class="alert alert-success text-center">
                    <?= $mensagem ?>
                </div>
            <?php endif; ?>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Título do Livro</label>
                    <input type="text" name="tituloLivro" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Autor</label>
                    <input type="text" name="autor" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Editora</label>
                    <input type="text" name="editora" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ISBN</label>
                    <input type="text" name="isbn" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Cadastrar Livro</button>
            </form>
            <button class="btn btn-logout w-100" onclick="window.history.back();">Voltar</button>
            <a href="../logout.php" class="btn btn-logout w-100">Sair</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>