<?php
# INICIALIZA O REPOSITÓRIO
require_once __DIR__ . '/../src/infraestrutura/basededados/repositorio-utilizador.php';

# MIDDLEWARE PARA GARANTIR QUE APENAS ADMNISTRADORES ACESSES ESTA PÁGINA
require_once __DIR__ . '/../src/middleware/middleware-administrador.php';

# FAZ O CARREGAMENTO DE TODOS OS UTILIZADORES PARA MOSTRAR AO ADMINISTRADOR
$utilizadores = lerTodosUtilizadores();

# CARREGA O CABECALHO PADRÃO COM O TÍTULO
$titulo = ' - Painel de Administração';
require_once __DIR__ . '/templates/cabecalho.php';
?>

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

  <section class="container">
    <input type="text" id="filterInput" class="form-control" placeholder="Filtrar por email" name="email" aria-label="Filtrar por email" aria-describedby="filter-button">
  </section>

  <section>
    <div class="table-responsive mt-3">
      <table class="table">
        <thead class="table-secondary">
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Apelido</th>
            <th scope="col">NIF</th>
            <th scope="col">Telemóvel</th>
            <th scope="col">Email</th>
            <th scope="col">Administrador</th>
            <th scope="col">Banido</th>
            <th scope="col">Gerenciar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          # VARRE TODOS OS UTILIZADORES PARA CONSTRUÇÃO DA TABELA
          foreach ($utilizadores as $utilizador) {
          ?>
            <tr>
              <th scope="row"><?= $utilizador['nome'] ?></th>
              <td><?= $utilizador['apelido'] ?></td>
              <td><?= $utilizador['nif'] ?></td>
              <td><?= $utilizador['telemovel'] ?></td>
              <td id="email<?= $utilizador['id'] ?>"><?= $utilizador['email'] ?></td>
              <td><?= $utilizador['administrador'] == '1' ? 'Sim' : 'Não' ?></td>
              <td><?= $utilizador["banido"] == "1" ? "Sim" : "Não" ?></td>
              <td>
                <div class="d-flex justify-content">
                  <a href="/src/controlador/admin/controlar-utilizador.php?<?= 'utilizador=atualizar&id=' . $utilizador['id'] ?>"><button type="button" class="btn btn-primary me-2">Atualizar</button></a>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletar<?= $utilizador['id'] ?>">Deletar</button>
                </div>
              </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="deletar<?= $utilizador['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar Utilizador</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Esta operação não poderá ser desfeita. Tem certeza que deseja deletar este utilizador?
                  </div>

                  <form id="form<?= $utilizador['id'] ?>">
                    <div class="input-group mb-3">
                      <div class="form-check form-switch mx-3 ">
                        <input class="form-check-input" type="checkbox" name="banir" role="switch" id="flexSwitchCheckChecked<?= $utilizador['id'] ?>" <?= isset($_REQUEST['banir']) && $_REQUEST['banir'] == true ? 'checked' : null ?>>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Banir</label>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">Motivo</span>
                      <textarea class="form-control" id="motivo<?= $utilizador['id'] ?>" name="motivo" maxlength="255" required disabled></textarea>
                    </div>
                  </form>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="/src/controlador/admin/controlar-utilizador.php?<?= 'utilizador=deletar&id=' . $utilizador['id'] ?>" id="confirmButton<?= $utilizador['id'] ?>">
                      <button type="button" class="btn btn-danger">Confirmar</button>
                    </a>
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
      <a href="/admin/utilizadores-banidos.php" class="flex-fill mx-2">
        <button class="btn btn-danger w-100">Utilizadores Banidos</button>
      </a>
      <a href="/aplicacao/" class="flex-fill mx-2">
        <button class="btn btn-dark w-100">Voltar</button>
      </a>

    </div>
  </section>
</main>
<script>
  document.querySelectorAll("[id^='flexSwitchCheckChecked']").forEach((checkbox) => {
    checkbox.addEventListener("change", function() {
      let id = this.id.replace('flexSwitchCheckChecked', '');
      document.getElementById('motivo' + this.id.replace('flexSwitchCheckChecked', '')).disabled = !this.checked;
      updateUrl(id);
    });
  });

  document.querySelectorAll("[id^='motivo']").forEach((textarea) => {
    textarea.addEventListener("input", function() {
      let id = this.id.replace('motivo', '');
      updateUrl(id);
    });
  });

  function updateUrl(id) {
    let banir = document.getElementById('flexSwitchCheckChecked' + id).checked ? 'true' : 'false';
    let motivo = document.getElementById('motivo' + id).value;
    let url = '/src/controlador/admin/controlar-utilizador.php?utilizador=deletar&id=' + id + '&banir=' + banir + '&motivo=' + encodeURIComponent(motivo);
    document.getElementById('confirmButton' + id).href = url;
  }


  const filterInput = document.getElementById('filterInput');

  const rows = document.querySelectorAll('tbody tr');
  const emails = document.querySelectorAll('tbody td[id^="email"]');

  filterInput.addEventListener("input", () => {
    const filter = filterInput.value.toLowerCase();
    rows.forEach((row, index) => {
      if (emails[index].innerText.toLowerCase().includes(filter)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
</script>
<?php
# CARREGA O RODAPE PADRÃO
require_once __DIR__ . '/templates/rodape.php';
?>