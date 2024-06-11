<?php
# FUNÇÕES AUXILIADORAS
require_once __DIR__ . '/src/middleware/middleware-nao-autenticado.php';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Administração Paulo Ministro</title>
</head>

<body>
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom d-flex justify-content-between">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none"><img src="/recursos/imagens/logo_paulo.png" alt="Logo Paulo Ministro" class="img-fluid mw-100" style="height: 100px;"></a>
                <a href="https://pauloministro.com">
                    <img src="/recursos/imagens/website.png" alt="Site Paulo Ministro" class="img-fluid mw-100" style="height: 100px;">
                </a>
                <div class="d-flex justify-content-between p-2 align-items-center">
                    <a href="https://instagram.com" target="_blank">
                        <img src="/recursos/imagens/instagram.png" alt="Instagram" class="img-fluid mw-100 p-2" style="height: 50px;">
                    </a>
                    <a href="https://facebook.com" target="_blank">
                        <img src="/recursos/imagens/facebook.png" alt="Facebook" class="img-fluid mw-100 p-2" style="height: 50px;">
                    </a>
                </div>
            </header>
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Bem vindo!</h1>
                    <p class="col-md-8 fs-4">Inicie sessão para ter acesso a informação exclusiva!</p>
                    <div class="d-flex justify-content">
                        <a href="/aplicacao/login.php" class="flex-fill mx-2"><button class="btn btn-success btn-lg  w-100">Login</button></a>
                        <a href="/aplicacao/registo.php" class="flex-fill mx-2"><button class="btn btn-info btn-lg w-100">Registo</button></a>
                    </div>
                </div>
            </div>

            <footer class="pt-2 mt-4 text-body-secondary border-top fixed-bottom text-center bg-light pb-2">
                IPVC ESTG - Desenvolvimento WEB | Lucas de Linhares &copy; - 2023-2024
            </footer>
        </div>
    </main>
</body>

</html>