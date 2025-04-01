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
    <title>Cadastrar Livros | Bibliotecário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --accent-color: #2e59d9;
            --error-color: #e74a3b;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: url('../assets/bg.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
            padding: 0 15px;
        }
        
        .form-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border-top: 4px solid var(--primary-color);
        }
        
        .form-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .form-header h2 {
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .form-body {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #d1d3e2;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 1.5rem;
        }
        
        .btn-back {
            background-color: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
        }
        
        .btn-logout {
            background-color: var(--error-color);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-logout:hover {
            background-color: #be2617;
        }
        
        .alert-success {
            background-color: rgba(78, 115, 223, 0.2);
            border-color: rgba(78, 115, 223, 0.3);
            color: var(--primary-color);
        }
        
        .isbn-hint {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        
        @media (max-width: 576px) {
            .form-body {
                padding: 1.5rem;
            }
            
            .btn-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-card">
            <div class="form-header">
                <h2><i class="bi bi-book"></i> Cadastrar Novo Livro</h2>
            </div>
            
            <div class="form-body">
                <?php if (isset($mensagem)) : ?>
                    <div class="alert alert-success text-center mb-4">
                        <i class="bi bi-check-circle-fill"></i> <?= $mensagem ?>
                    </div>
                <?php endif; ?>
                
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-book text-primary"></i> Título do Livro
                        </label>
                        <input type="text" name="tituloLivro" class="form-control" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-person text-primary"></i> Autor
                        </label>
                        <input type="text" name="autor" class="form-control" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-building text-primary"></i> Editora
                        </label>
                        <input type="text" name="editora" class="form-control" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-upc-scan text-primary"></i> ISBN
                        </label>
                        <input type="text" name="isbn" class="form-control" required>
                        <div class="isbn-hint">Formato: 978-85-333-0227-3</div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" class="btn btn-submit text-white flex-grow-1">
                            <i class="bi bi-save-fill me-2"></i> Cadastrar Livro
                        </button>
                        <button type="button" onclick="window.history.back();" class="btn btn-back text-white">
                            <i class="bi bi-arrow-left me-2"></i> Voltar
                        </button>
                        <a href="../logout.php" class="btn btn-logout text-white">
                            <i class="bi bi-box-arrow-right me-2"></i> Sair
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    
    </script>
</body>

</html>