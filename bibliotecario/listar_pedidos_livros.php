<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== "bibliotecario") {
    header("Location: index.php");
    exit;
}

$filename = "../professor/list_de_pedidos.txt";
$pedidos = [];

if (file_exists($filename)) {
    $file = fopen($filename, "r");
    while (($line = fgets($file)) !== false) {
        $pedidos[] = trim($line);
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">📖 Pedidos de Livros</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Detalhes do Pedido</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($pedidos) > 0): ?>
                    <?php foreach ($pedidos as $index => $pedido): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($pedido); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center">Nenhum pedido registrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-primary">Voltar ao Painel</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>