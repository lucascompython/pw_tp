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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>CRUD</title>
</head>

<body>
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none"><img src="/recursos/imagens/logo-estg.svg" alt="ESTG" class="mw-100"></a>
            </header>
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Bem vindo!</h1>
                    <p class="col-md-8 fs-4">Para ter acesso a informações exclusivas desse sistema, que foi
                        desenvolvido
                        com Bootstrap e PHP, você terá que fazer seu login ou registro.</p>
                    <div class="d-flex justify-content">
                        <a href="/aplicacao/login.php"><button class="btn btn-success btn-lg px-5 me-2">Login</button></a>
                        <a href="/aplicacao/registo.php"><button class="btn btn-info btn-lg px-4">Registo</button></a>
                    </div>
                </div>
            </div>

            <footer class="pt-3 mt-4 text-body-secondary border-top">
                IPVC ESTG - Desenvolvimento WEB | Professor Wenderson Wanzeller &copy; - 2022-2023
            </footer>
        </div>
    </main>
</body>

</html>