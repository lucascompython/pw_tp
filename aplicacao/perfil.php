<?php
# CARREGA MIDDLEWARE PAGARA GARANTIR QUE APENAS UTILIZADORES AUTENTICADOS ACESSEM ESTE SITIO
require_once __DIR__ . '/../src/middleware/middleware-utilizador.php';

# CARREGA O CABECALHO PADRÃO COM O TÍTULO
$titulo = ' - Perfil';
include_once __DIR__ . '/templates/cabecalho.php';

# ACESSA DE FUNÇÕES AUXILIADORAS. 
# NOTA: O SIMBOLO ARROBA SERVE PARA NÃO MOSTRAR MENSAGEM DE WARNING, POIS A FUNÇÃO ABAIXO TAMBÉM INICIA SESSÕES
@require_once __DIR__ . '/../src/auxiliadores/auxiliador.php';
$utilizador = utilizador();
?>

<body class="container bg-light">
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


  <div class="pt-1">
    <div class="p-3 mb-2 text-white text-center bg-dark rounded">
      <h1>Registo de Utilizadores</h1>
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
        <form enctype="multipart/form-data" action="/src/controlador/admin/controlar-utilizador.php" method="post" class="form-control py-3">
          <div class="input-group mb-3">
            <span class="input-group-text">Nome</span>
            <input type="text" class="form-control" name="nome" placeholder="nome" maxlength="100" size="100" value="<?= isset($_REQUEST['nome']) ? $_REQUEST['nome'] : $utilizador['nome'] ?>" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Apelido</span>
            <input type="text" class="form-control" name="apelido" maxlength="100" size="100" value="<?= isset($_REQUEST['apelido']) ? $_REQUEST['apelido'] : $utilizador['apelido'] ?>" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">NIF</span>
            <input type="tel" class="form-control" name="nif" maxlength="9" size="9" value="<?= isset($_REQUEST['nif']) ? $_REQUEST['nif'] : $utilizador['nif'] ?>" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Telemóvel</span>
            <input type="tel" class="form-control" name="telemovel" maxlength="9" value="<?= isset($_REQUEST['telemovel']) ? $_REQUEST['telemovel'] : $utilizador['telemovel'] ?>" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">E-mail</span>
            <input type="email" class="form-control" name="email" maxlength="255" value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : $utilizador['email'] ?>" required>
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Foto de Perfil</label>
            <input accept="image/*" type="file" class="form-control" id="inputGroupFile01" name="foto" />
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text">Palavra Passe</span>
            <input type="password" class="form-control" name="palavra_passe" maxlength="255">
          </div>

          <div class="d-flex justify-content-between w-100">
            <div class="flex-fill mx-2">
              <button class="w-100 btn btn-success" type="submit" name="utilizador" value="perfil">Alterar</button>
            </div>
            <a href="/aplicacao/" class="flex-fill mx-2"><button type="button" class="btn btn-secondary w-100">Voltar</button></a>
          </div>
        </form>
      </section>
    </main>
    <?php
    include_once __DIR__ . '/templates/rodape.php';
    ?>