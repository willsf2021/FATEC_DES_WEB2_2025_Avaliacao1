<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) && $_SESSION['tipoUsuario'] == "professor") {

    if (!empty($_POST['tituloLivro']) && !empty($_POST['autor']) && !empty($_POST['editora']) && !empty($_POST['isbn'])) {
        $filename = "pedidos.txt";
        $handle = fopen($filename, file_exists($filename) ? "a" : "w");

        $conteudo = [
            "Nome do Livro" => $_POST['tituloLivro'],
            "Autor" => $_POST['autor'],
            "Editora" => $_POST['editora'],
            "ISBN" => $_POST['isbn'],
            "Professor" => $_SESSION['userName'],
            "Data" => date('d/m/Y H:i:s')
        ];

        $linha = json_encode($conteudo) . PHP_EOL;
        fwrite($handle, $linha);
        fflush($handle);
        fclose($handle);

        $mensagem = "Pedido cadastrado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pedido de Livro | Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #1cc88a;
            --accent-color: #17a673;
            --error-color: #e74a3b;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fc;
            min-height: 100vh;
            padding-top: 2rem;
        }
        
        .form-container {
            max-width: 700px;
            margin: 0 auto;
        }
        
        .form-card {
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--primary-color);
            overflow: hidden;
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
            background-color: white;
        }
        
        .form-floating label {
            color: #6c757d;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid #d1d3e2;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(28, 200, 138, 0.25);
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
        
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-secondary:hover {
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
            background-color: rgba(28, 200, 138, 0.2);
            border-color: rgba(28, 200, 138, 0.3);
            color: #1c8a5d;
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
                <h2><i class="bi bi-journal-plus"></i> Novo Pedido de Livro</h2>
            </div>
            
            <div class="form-body">
                <?php if (isset($mensagem)) : ?>
                    <div class="alert alert-success text-center mb-4">
                        <i class="bi bi-check-circle-fill"></i> <?= $mensagem ?>
                    </div>
                <?php endif; ?>
                
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="form-floating mb-4">
                        <input type="text" name="tituloLivro" class="form-control" id="tituloLivro" placeholder="Título do Livro" required>
                        <label for="tituloLivro"><i class="bi bi-book text-primary me-2"></i>Título do Livro</label>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="text" name="autor" class="form-control" id="autor" placeholder="Autor" required>
                        <label for="autor"><i class="bi bi-person text-primary me-2"></i>Autor(es)</label>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="text" name="editora" class="form-control" id="editora" placeholder="Editora" required>
                        <label for="editora"><i class="bi bi-building text-primary me-2"></i>Editora</label>
                    </div>
                    
                    <div class="form-floating mb-4">
                        <input type="text" name="isbn" class="form-control" id="isbn" placeholder="ISBN" required>
                        <label for="isbn"><i class="bi bi-upc-scan text-primary me-2"></i>ISBN</label>
                        <div class="isbn-hint">Exemplo: 978-85-333-0227-3</div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="submit" class="btn btn-submit text-white flex-grow-1">
                            <i class="bi bi-send-fill me-2"></i> Enviar Pedido
                        </button>
                        <button type="button" onclick="window.history.back();" class="btn btn-secondary text-white">
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
    
</body>

</html>