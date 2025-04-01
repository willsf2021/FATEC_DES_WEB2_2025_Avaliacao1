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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
            --text-dark: #5a5c69;
            --text-light: #858796;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-container {
            position: relative;
            max-width: 500px;
            width: 100%;
            margin: 0 20px;
        }

        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-color: white;
            position: relative;
            z-index: 1;
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            text-align: center;
            padding: 1.5rem;
            border-bottom: none;
        }

        .card-header h2 {
            font-weight: 600;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
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

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: var(--accent-color);
            transform: translateY(-2px);
        }

        .user-type-selector {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .user-type-btn {
            flex: 1;
            border: 2px solid #d1d3e2;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background-color: white;
        }

        .user-type-btn:hover {
            border-color: var(--primary-color);
        }

        .user-type-btn.active {
            border-color: var(--primary-color);
            background-color: rgba(78, 115, 223, 0.1);
        }

        .user-type-btn i {
            font-size: 24px;
            margin-bottom: 5px;
            display: block;
            color: var(--primary-color);
        }

        input[type="radio"] {
            display: none;
        }

        .floating-decoration {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .decoration-1 {
            top: -50px;
            right: -50px;
        }

        .decoration-2 {
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
        }

        .form-floating label {
            color: var(--text-light);
        }
    </style>
</head>

<body>
    <div class="floating-decoration decoration-1"></div>
    <div class="floating-decoration decoration-2"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <h2><i class="bi bi-book"></i> Biblioteca Espaço do Saber</h2>
            </div>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="user-type-selector mb-4">
                        <label class="user-type-btn active" for="bibliotecario">
                            <i class="bi bi-book-half"></i>
                            Bibliotecário
                            <input type="radio" name="tipoUsuario" value="bibliotecario" id="bibliotecario" checked>
                        </label>
                        <label class="user-type-btn" for="professor">
                            <i class="bi bi-person-video3"></i>
                            Professor
                            <input type="radio" name="tipoUsuario" value="professor" id="professor">
                        </label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" placeholder="Nome de Usuário">
                        <label for="nomeUsuario"><i class="bi bi-person-fill me-2"></i>Nome de Usuário</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                        <label for="senha"><i class="bi bi-lock-fill me-2"></i>Senha</label>
                    </div>

                    <button type="submit" class="btn btn-login btn-primary w-100 py-3 fw-bold">
                        ENTRAR <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ativa o estilo do botão de tipo de usuário selecionado
        document.querySelectorAll('.user-type-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.user-type-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });
    </script>
</body>

</html>