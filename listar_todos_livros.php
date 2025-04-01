<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$filename = "bibliotecario/livros.txt";
$livros = [];

if (file_exists($filename)) {
    $file = fopen($filename, "r");
    while (($line = fgets($file)) !== false) {
        $livroData = json_decode(trim($line), true);
        if ($livroData) {
            $livros[] = $livroData;
        } else {

            $livros[] = ['detalhes' => trim($line)];
        }
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros | Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --accent-color: #2e59d9;
            --header-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
            color: #5a5c69;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }
        
        .header-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary-color);
        }
        
        .header-card h2 {
            color: var(--primary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            margin: 0;
        }
        
        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead {
            background-color: var(--primary-color);
            color: white;
        }
        
        .table th {
            font-weight: 600;
            padding: 1rem;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        .book-details {
            display: flex;
            flex-direction: column;
        }
        
        .book-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .book-info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 0.9rem;
            color: #858796;
        }
        
        .book-info span {
            display: flex;
            align-items: center;
        }
        
        .book-info i {
            margin-right: 5px;
            color: var(--primary-color);
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #d1d3e2;
            margin-bottom: 1rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 1.5rem;
        }
        
        .btn-back {
            background-color: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
            color: white;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .btn-logout {
            background-color: #e74a3b;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
            color: white;
        }
        
        .btn-logout:hover {
            background-color: #be2617;
            color: white;
        }
        
        @media (max-width: 768px) {
            .book-info {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="header-card">
            <h2><i class="bi bi-book me-2"></i> Acervo da Biblioteca</h2>
        </div>
        
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Detalhes do Livro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($livros) > 0): ?>
                        <?php foreach ($livros as $index => $livro): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if (is_array($livro)): ?>
                                        <div class="book-details">
                                            <div class="book-title"><?= htmlspecialchars($livro['Nome do Livro'] ?? $livro['detalhes'] ?? 'Livro sem título') ?></div>
                                            <div class="book-info">
                                                <?php if (isset($livro['Autor'])): ?>
                                                    <span><i class="bi bi-person"></i> <?= htmlspecialchars($livro['Autor']) ?></span>
                                                <?php endif; ?>
                                                <?php if (isset($livro['Editora'])): ?>
                                                    <span><i class="bi bi-building"></i> <?= htmlspecialchars($livro['Editora']) ?></span>
                                                <?php endif; ?>
                                                <?php if (isset($livro['ISBN'])): ?>
                                                    <span><i class="bi bi-upc-scan"></i> <?= htmlspecialchars($livro['ISBN']) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?= htmlspecialchars($livro) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">
                                <div class="empty-state">
                                    <i class="bi bi-book"></i>
                                    <h4>Nenhum livro cadastrado</h4>
                                    <p>O acervo da biblioteca está vazio no momento.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="action-buttons">
            <button onclick="window.history.back();" class="btn-back">
                <i class="bi bi-arrow-left me-2"></i> Voltar
            </button>
            <a href="logout.php" class="btn-logout">
                <i class="bi bi-box-arrow-right me-2"></i> Sair
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>