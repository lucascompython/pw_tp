<?php
# MIDDLEWARE PARA GARANTIR QUE APENAS UTILIZADORES NÃO AUTENTICADOS VEJAM A PÁGINA DE LOGIN
require_once __DIR__ . '/../src/middleware/middleware-nao-autenticado.php';

# DEFINI O TÍTULO DA PÁGINA
$titulo = ' - Login';

# INICIA CABECALHO
include_once __DIR__ . '/templates/cabecalho.php';
?>

<body class="d-flex flex-column justify-content-center" style="min-height: 100vh;">

  <div class="container py-4">
    <header class="pb-3 border-bottom d-flex justify-content-between">
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

  <div class="container d-flex align-items-center justify-content-center text-center bg-light" style="flex: 1;">
    <div class="w-75">
      <main>
        <section>
          <?php
          # MOSTRA AS MENSAGENS DE ERRO CASO LOGIN SEJA INVÁLIDO
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
        <form action="/src/controlador/aplicacao/controlar-autenticacao.php" method="post">
          <h1 class="h3 mb-3 fw-normal">LOGIN</h1>
          <div class="form-floating mb-2">
            <input type="email" class="form-control" id="Email" placeholder="Email" name="email" maxlength="255" value="<?= isset($_REQUEST['email']) ? $_REQUEST['email'] : null ?>" required>
            <label for="Email">Endereço de Email</label>
          </div>
          <div class="form-floating mb-2">
            <input type="password" class="form-control" id="palavra_passe" placeholder="Palavra Passe" name="palavra_passe" maxlength="255" value="<?= isset($_REQUEST['palavra_passe']) ? $_REQUEST['palavra_passe'] : null ?>" required>
            <label for="palavra_passe">Palavra Passe</label>
          </div>
          <div class="checkbox mb-3">
            <label><input type="checkbox" value="lembra-me">Lembrar-me</label>
          </div>
          <button class="w-100 btn btn-lg btn-success mb-2" type="submit" name="utilizador" value="login">Entrar</button>
        </form>
        <a href="/"><button class="w-100 btn btn-lg btn-info">Voltar</button></a>
      </main>
      <?php
      include_once __DIR__ . '/templates/rodape.php';
      ?>
    </div>