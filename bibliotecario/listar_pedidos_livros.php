<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== "bibliotecario") {
    header("Location: index.php");
    exit;
}

$filename = "../professor/pedidos.txt";
$pedidos = [];

if (file_exists($filename)) {
    $file = fopen($filename, "r");
    while (($line = fgets($file)) !== false) {
        $pedidoData = json_decode(trim($line), true);
        if ($pedidoData) {
            $pedidos[] = $pedidoData;
        } else {
            $pedidos[] = ['detalhes' => trim($line)];
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
    <title>Pedidos de Livros | Bibliotecário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --accent-color: #2e59d9;
            --success-color: #1cc88a;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
            color: #5a5c69;
            background: url('../assets/bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }

        .header-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary-color);
            backdrop-filter: blur(5px);
        }

        .header-card h2 {
            color: var(--primary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            margin: 0;
            gap: 10px;
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(5px);
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

        .pedido-details {
            display: flex;
            flex-direction: column;
        }

        .pedido-title {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .pedido-info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 0.9rem;
            color: #858796;
        }

        .pedido-info span {
            display: flex;
            align-items: center;
        }

        .pedido-info i {
            margin-right: 5px;
        }

        .pedido-actions {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 5px 10px;
            font-size: 0.85rem;
            border: none;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-approve {
            background-color: var(--success-color);
            color: white;
        }

        .btn-deny {
            background-color: var(--danger-color);
            color: white;
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
            background-color: var(--danger-color);
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

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #f8f4e6;
            color: #856404;
        }

        @media (max-width: 768px) {
            .pedido-info {
                flex-direction: column;
                gap: 5px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .pedido-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="header-card">
            <h2><i class="bi bi-journal-text"></i> Pedidos de Livros</h2>
            <p class="mb-0 text-muted">Gerencie os pedidos de livros feitos pelos professores</p>
        </div>

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Detalhes do Pedido</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($pedidos) > 0): ?>
                        <?php foreach ($pedidos as $index => $pedido): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td>
                                    <?php if (is_array($pedido)): ?>
                                        <div class="pedido-details">
                                            <div class="pedido-title"><?= htmlspecialchars($pedido['Nome do Livro'] ?? $pedido['detalhes'] ?? 'Pedido sem título') ?></div>
                                            <div class="pedido-info">
                                                <?php if (isset($pedido['Autor'])): ?>
                                                    <span><i class="bi bi-person"></i> <?= htmlspecialchars($pedido['Autor']) ?></span>
                                                <?php endif; ?>
                                                <?php if (isset($pedido['Editora'])): ?>
                                                    <span><i class="bi bi-building"></i> <?= htmlspecialchars($pedido['Editora']) ?></span>
                                                <?php endif; ?>
                                                <?php if (isset($pedido['Professor'])): ?>
                                                    <span><i class="bi bi-person-video3"></i> Prof. <?= htmlspecialchars($pedido['Professor']) ?></span>
                                                <?php endif; ?>
                                                <?php if (isset($pedido['Data'])): ?>
                                                    <span><i class="bi bi-calendar"></i> <?= htmlspecialchars($pedido['Data']) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?= htmlspecialchars($pedido) ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="bi bi-journal-x"></i>
                                    <h4>Nenhum pedido encontrado</h4>
                                    <p>Não há pedidos de livros pendentes no momento.</p>
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
            <a href="../logout.php" class="btn-logout">
                <i class="bi bi-box-arrow-right me-2"></i> Sair
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Funções para aprovar/recusar pedidos (seriam implementadas com AJAX)
        document.querySelectorAll('.btn-approve').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                // Aqui iria a chamada AJAX para aprovar o pedido
                alert('Pedido aprovado com sucesso!');
                row.remove();
            });
        });

        document.querySelectorAll('.btn-deny').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                // Aqui iria a chamada AJAX para recusar o pedido
                alert('Pedido recusado com sucesso!');
                row.remove();
            });
        });
    </script>
</body>

</html>