<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['tipoUsuario'] !== "bibliotecario") {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Estilizada */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            min-height: 100vh;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            position: fixed;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .sidebar-header h3 i {
            margin-right: 10px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* Conteúdo Principal */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2rem;
        }

        .welcome-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
            border-left: 5px solid var(--primary-color);
        }

        .welcome-card h2 {
            color: var(--primary-color);
            font-weight: 600;
        }

        .welcome-card p {
            color: #6c757d;
        }

        /* Cards de Ação */
        .action-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .action-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            transition: all 0.3s;
            border-top: 3px solid var(--primary-color);
            text-align: center;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .action-card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .action-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #5a5c69;
        }

        .action-card p {
            color: #858796;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .action-card .btn {
            width: 100%;
            background-color: var(--primary-color);
            border: none;
            padding: 8px;
            font-weight: 600;
        }

        .action-card .btn:hover {
            background-color: var(--accent-color);
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        .logout-btn {
            background-color: #e74a3b;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background-color: #be2617;
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                min-height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="bi bi-book"></i> Espaço do Saber</h3>
        </div>
        <nav class="nav flex-column mt-3">
            <a class="nav-link active" href="#">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link" href="bibliotecario/cadastrar_livros.php">
                <i class="bi bi-journal-plus"></i> Cadastrar Livros
            </a>
            <a class="nav-link" href="bibliotecario/listar_pedidos_livros.php">
                <i class="bi bi-list-check"></i> Visualizar Pedidos
            </a>
            <a class="nav-link" href="listar_todos_livros.php">
                <i class="bi bi-book"></i> Todos os Livros
            </a>
        </nav>
    </div>

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['userName']) ?>&background=4e73df&color=fff" alt="User">
                <span>Olá, <?= htmlspecialchars($_SESSION['userName']) ?></span>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Sair
            </a>
        </div>

        <!-- Card de Boas-Vindas -->
        <div class="welcome-card">
            <h2>Bem-vindo ao Painel do Bibliotecário</h2>
            <p>Aqui você pode gerenciar todos os aspectos da biblioteca.</p>
        </div>

        <!-- Cards de Ação Rápida -->
        <div class="action-cards">
            <div class="action-card">
                <i class="bi bi-journal-plus"></i>
                <h3>Cadastrar Livros</h3>
                <p>Adicione novos títulos ao acervo da biblioteca</p>
                <a href="bibliotecario/cadastrar_livros.php" class="btn btn-primary">Acessar</a>
            </div>

            <div class="action-card">
                <i class="bi bi-list-check"></i>
                <h3>Recomendações de Compra</h3>
                <p>Visualize as recomendações de compra de livros dadas pelos professores</p>
                <a href="bibliotecario/listar_pedidos_livros.php" class="btn btn-primary">Visualizar</a>
            </div>

            <div class="action-card">
                <i class="bi bi-book"></i>
                <h3>Acervo Completo</h3>
                <p>Explore todos os livros disponíveis na biblioteca</p>
                <a href="listar_todos_livros.php" class="btn btn-primary">Ver Livros</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Adiciona classe active ao item de menu clicado
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>