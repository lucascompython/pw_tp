<?php
# INICIALIZA O REPOSITÓRIO
require_once __DIR__ . '/../src/infraestrutura/basededados/repositorio-utilizador.php';

# MIDDLEWARE PARA GARANTIR QUE APENAS ADMNISTRADORES ACESSES ESTA PÁGINA
require_once __DIR__ . '/../src/middleware/middleware-administrador.php';

# FAZ O CARREGAMENTO DE TODOS OS UTILIZADORES PARA MOSTRAR AO ADMINISTRADOR
$utilizadoresBanidos = lerTodosUtilizadoresBanidos();

# CARREGA O CABECALHO PADRÃO COM O TÍTULO
$titulo = ' - Utilizadores Banidos';
// require_once __DIR__ . '/templates/cabecalho.php';
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Administração Paulo Ministro - Utilizadores Banidos</title>
</head>

<body class="container bg-light">
    <div>

        <div class="conatiner py-3">

            <header class="pb-3 mb-1 border-bottom d-flex justify-content-between">
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
        </div>
        <div class="p-3 mb-2 text-white text-center bg-dark rounded">
            <h1>Utilizadores Banidos</h1>
        </div>

        <main class="bg-light">

            <section>
                <?php
                # MOSTRA AS MENSAGENS DE SUCESSO E DE ERRO VINDA DO CONTROLADOR-UTILIZADOR
                if (isset($_SESSION['sucesso'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo $_SESSION['sucesso'] . '<br>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    unset($_SESSION['sucesso']);
                }
                if (isset($_SESSION['erros'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    foreach ($_SESSION['erros'] as $erro) {
                        echo $erro . '<br>';
                    }
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    unset($_SESSION['erros']);
                }
                ?>
            </section>
            <section>
                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Motivo</th>
                                <th scope="col">Gerenciar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            # VARRE TODOS OS UTILIZADORES PARA CONSTRUÇÃO DA TABELA
                            foreach ($utilizadoresBanidos as $utilizador) {
                            ?>
                                <tr>
                                    <td><?= $utilizador['email'] ?></td>
                                    <td><?= $utilizador['motivo'] ?></td>
                                    <td>
                                        <div class="d-flex justify-content">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#unban<?= $utilizador['id'] ?>">Desbanir</button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="unban<?= $utilizador['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Desbanir Utilizador</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Ao desbanir o utilizador, ele poderá criar uma nova conta e voltar a utilizar o sistema. Tem a certeza que deseja desbanir o utilizador?
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <a href="/src/controlador/admin/controlar-utilizador.php?<?= 'utilizador=desbanir&id=' . $utilizador['id'] ?>"><button type="button" class="btn btn-danger">Desbanir</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fim Modal -->
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="py-4">
                <div class="d-flex w-100 justify-content-between">
                    <a href="/admin/utilizador.php" class="flex-fill mx-2">
                        <button class="btn btn-success w-100">Criar Utilizador</button>
                    </a>
                    <a href="/admin/" class="flex-fill mx-2">
                        <button class="btn btn-dark w-100">Voltar</button>
                    </a>

                </div>
            </section>
        </main>
        <?php
        # CARREGA O RODAPE PADRÃO
        require_once __DIR__ . '/templates/rodape.php';
        ?>