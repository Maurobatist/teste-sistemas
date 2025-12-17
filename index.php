<?php
require 'conectar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Site cadastro</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
  </head>
  <body>
<main class="flex-fill">
    <!--Menu-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Internet das Coisas</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tutoriais</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Cursos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Arduino</a></li>
                <li><a class="dropdown-item" href="#">Sensores</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>

    <!-- grid-->
    <div class="container text-center">
      <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col"></div>
        <div class="col">
          <!--Formulario-->
          <form class="row g-3" action="cadastrar.php" method="POST">
            <div class="col-12">
              <label for="inputpeca" class="form-label">Nome da peça: </label>
              <input
                type="text"
                class="form-control"
                id="inputpeca"
                placeholder="Insira nome da peça"
                name="nome_peca"
              />
            </div>

            <div class="col-12">
              <label for="inputquantidade" class="form-label"
                >Quantidade
              </label>
              <input
                type="number"
                class="form-control"
                id="inputquantidade"
                placeholder="Quantidade"
                name="quantidade"
              />
            </div>

            <div class="col-12">
              <label for="inputlocal" class="form-label">Localização </label>
              <input
                type="text"
                class="form-control"
                id="inputlocal"
                placeholder="Localização"
                name="localizacao"
              />
            </div>

            <div class="col-12">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </form>
          <br />
          <br />
          <!--Tabela
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Localização</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Arduino</td>
                <td>2</td>
                <td>Armario 1</td>
              </tr>
            </tbody>
          </table> -->

          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Localização</th>
                <th>Ações</th>
              </tr>
            </thead>

            <tbody>
              <?php
    // Consulta no banco
    $sql = "SELECT id_peca, nome_peca, quantidade, localizacao FROM pecas";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute(); 
    // foreach para percorrer os registros 
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $linha) {
              ?>
              <tr>
                <th scope="row"><?= $linha['id_peca']; ?></th>
                <td><?= $linha['nome_peca']; ?></td>
                <td><?= $linha['quantidade']; ?></td>
                <td><?= $linha['localizacao']; ?></td>


                <td>
                    <!-- Botão Editar -->
                    <a href="editar.php?id=<?= $linha['id_peca']; ?>" 
                    class="btn btn-sm btn-warning">
                    Editar
                    </a>

                    <!-- Botão Excluir -->
                    <a href="excluir.php?id=<?= $linha['id_peca']; ?>" 
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Deseja realmente excluir esta peça?');">
                    Excluir
                    </a>
                </td>


              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="col"></div>
      </div>
    </div>
    </main>

    <!--Rodapé-->
    <footer class="bg-light border-top py-3 mt-auto">
      <div class="container text-center">
        <div class="row align-items-center">
          <div class="col-md-12 text-md-center text-muted">
            <small>&copy; 2025 - Internet das Coisas</small>
          </div>
        </div>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
