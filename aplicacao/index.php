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
?>

<body>
    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none"><img src="/recursos/imagens/logo-estg.svg" alt="ESTG" class="mw-100"></a>
            </header>
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Olá <?= $utilizador['nome'] ?? null ?> !</h1>
                    <p class="col-md-8 fs-4">Agora que está logado no sistema, você tem acesso a informações
                        exclusivas.</p>
                    <div class="d-flex justify-content">
                        <form action="/src/controlador/aplicacao/controlar-autenticacao.php" method="post">
                            <button class="btn btn-danger btn-lg px-4" type="submit" name="utilizador" value="logout">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row align-items-md-stretch">
                <div class="col-md-6">
                    <div class="h-100 p-5 text-bg-dark rounded-3">
                        <h2>Perfil</h2>
                        <p>Este painel é utilizado para destacar que utilizadores REGISTADOS podem alterar o próprio perfil. Aqui
                            você poderá editar e cancelar a sua assinatura no sistema. <strong class="text-warning">E se estiver vendo
                                este parágrafo, significa que você precisa completar o seu perfil.</strong></p>
                        <a href="/aplicacao/perfil.php"><button class="btn btn-outline-light px-5" type="button">Editar</button></a>
                    </div>
                </div>

                <?php
                # MOSTRA CARD APENAS SE UTILIZDOR FOR ADMINISTRADOR
                if (autenticado() && $utilizador['administrador']) {
                    echo '<div class="col-md-6">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <h2>Painel de Administração</h2>
                        <p>Este painel é exclusivo para utilizadores REGISTADOS e que tenham o perfil de ADMINISTRADOR. Aqui você poderá criar,
                            alterar, apagar, promover e despromover outros utilizadores a administradores do sistema.</p>
                        <a href="/admin/"><button class="btn btn-outline-success" type="button">Administração</button></a>
                    </div>
                </div>';
                }
                ?>
            </div>
            <?php
            include_once __DIR__ . '/templates/rodape.php';
            ?>