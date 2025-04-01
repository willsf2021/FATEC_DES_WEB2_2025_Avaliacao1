<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== "professor") {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Bibliotecário</title>
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

        .list-group-item {
            font-size: 18px;
            transition: all 0.2s;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
        }

        .btn-logout:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card p-4">
            <h2 class="text-center mb-4">Painel do Professor</h2>
            <ul class="list-group mb-4">
                <li class="list-group-item">
                    <a href="./professor/cadastrar_pedido.php" class="text-decoration-none text-dark d-block">📚 Cadastrar Pedido de Livro</a>
                </li>
                <li class="list-group-item">
                    <a href="listar_todos_livros.php" class="text-decoration-none text-dark d-block">📙 Listar Todos os Livros</a>
                </li>
            </ul>
            <a href="logout.php" class="btn btn-logout w-100">Sair</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>