<?php
# CARREGA MIDDLEWARE PAGARA GARANTIR QUE APENAS UTILIZADORES AUTENTICADOS ACESSEM ESTE SITIO
require_once __DIR__ . '/../src/middleware/middleware-utilizador.php';

# ACESSA DE FUNÇÕES AUXILIADORAS. 
# NOTA: O SIMBOLO ARROBA SERVE PARA NÃO MOSTRAR MENSAGEM DE WARNING, POIS A FUNÇÃO ABAIXO TAMBÉM INICIA SESSÕES
@require_once __DIR__ . '/../src/auxiliadores/auxiliador.php';

# PROVENIENTE DE FUNÇÕES AUXILIADORAS. CARREGA O UTILIZADOR ATUAL
$utilizador = utilizador();

# CARREGA O CABECALHO PADRÃO COM O TÍTULO
$titulo = '- Aplicação';
include_once __DIR__ . '/templates/cabecalho.php';

date_default_timezone_set("Europe/Lisbon");
?>

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

            <div class="row">
                <div class="col-md-4">
                    <div class="p-3 mb-4 bg-body-tertiary rounded-3 position-relative h-100 d-flex flex-column">
                        <div class="container-fluid flex-grow-1">
                            <div>
                                <div class="d-flex align-items-center justify-content-between border-bottom mb-5">
                                    <h3 class="fw-bold">Olá <?= $utilizador['nome'] ?? null ?> !</h3>
                                    <img src="<?= !empty($utilizador['foto']) ? '/recursos/imagens/uploads/' . $utilizador['foto'] : '/recursos/imagens/default_pfp.svg' ?>" alt="Profile Picture" class="m-3 rounded-circle card-img-top " style="width: 100px; height: 100px;">
                                </div>
                                <p class="fs-6">Agora que está logado no sistema, você tem acesso a informações exclusivas.</p>
                                <p class="fs-5">Hora Atual em Portugal: <?= date('H:i:s') ?></p>
                                <p class="fs-5">Hora Atual em Espanha: <?= date('H:i:s', strtotime('+1 hour')) ?></p>
                            </div>
                        </div>
                        <form action="/src/controlador/aplicacao/controlar-autenticacao.php" method="post">
                            <button class="btn btn-danger btn-lg px-4 w-100" type="submit" name="utilizador" value="logout">Logout</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="h-100 p-5 text-bg-dark rounded-3">
                                <h2>Perfil</h2>
                                <p>Este painel é utilizado para destacar que utilizadores REGISTADOS podem alterar o próprio perfil. Aqui você poderá editar e cancelar a sua assinatura no sistema. <strong class="text-warning">E se estiver vendo este parágrafo, significa que você precisa completar o seu perfil.</strong></p>
                                <a href="/aplicacao/perfil.php"><button class="btn btn-outline-light px-5" type="button">Editar</button></a>
                            </div>
                        </div>

                        <?php
                        # MOSTRA CARD APENAS SE UTILIZDOR FOR ADMINISTRADOR
                        if (autenticado() && $utilizador['administrador']) {
                            echo '<div class="col-md-12">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Painel de Administração</h2>
                    <p>Este painel é exclusivo para utilizadores REGISTADOS e que tenham o perfil de ADMINISTRADOR. Aqui você poderá criar, alterar, apagar, promover e despromover outros utilizadores a administradores do sistema.</p>
                    <a href="/admin/"><button class="btn btn-outline-success" type="button">Administração</button></a>
                </div>
            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php
            include_once __DIR__ . '/templates/rodape.php';
            ?>