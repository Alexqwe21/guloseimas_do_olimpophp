<style>
  button {
    border: none;
    background-color: transparent;
  }

  .pg_produto {
    width: 230px;
    height: 230px;
    border-radius: 5px;
  }
</style>






<a href="<?php echo BASE_URL . 'produtos/adicionar/'  ?>" class="btn btn-primary mb-3">ADICIONAR</a>
<form method="GET" class="mb-3 row g-2">
  <div class="col-md-3">
    <label for="status" class="form-label">Filtrar por status:</label>
    <select name="status" id="status" class="form-select" onchange="this.form.submit()">
      <option value="">Todos</option>
      <option value="Ativo" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
      <option value="Inativo" <?php echo (isset($_GET['status']) && $_GET['status'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
    </select>
  </div>

  <div class="col-md-3">
    <label for="busca" class="form-label">Buscar por nome ou ID:</label>
    <input type="text" name="busca" id="busca" class="form-control" placeholder="Ex: 10 ou Chocolate"
      value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
  </div>

  <div class="col-md-2 d-flex align-items-end">
    <button type="submit" class="btn btn-success w-100">Buscar</button>
  </div>
</form>



<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Foto</th>
      <th scope="col">Nome</th>
      <th scope="col">Preço</th>
      <th scope="col">Status</th>
      <!-- <th scope="col">Tempo</th> -->
      <!-- <th scope="col">Especialidade</th> -->
      <th scope="col">Editar</th>
      <th scope="col">Desativar/Ativar</th>


    </tr>
  </thead>
  <tbody>
    <?php foreach ($listarServico as $linha): ?>

      <tr>
        <th scope="row"><?php echo $linha['id_produto'] ?></th>
        <td><img src="<?php echo BASE_URL . 'uploads/' . $linha['foto_produto'] ?>" alt="<?php echo $linha['alt_foto_produto'] ?>" class="pg_produto"></td>

        <td><?php echo $linha['nome_produto'] ?></td>

        <td><?php echo $linha['preco_produto'] ?></td>

        <td><?php echo $linha['status_pedido'] ?></td>



        <td>
          <a href="<?php echo BASE_URL . 'produtos/editar/' . $linha['id_produto']; ?>">
            <button><i class="bi bi-pencil-fill"></i></button>
          </a>

          <a href="/<?php echo BASE_URL . 'produtos/status/' . $linha['id_produto']; ?>">
            <button><i class=""></i></button>
          </a>

        <td>




          <a href="<?php echo BASE_URL . 'produtos/status/' . $linha['id_produto']; ?>">
            <button><i class="bi bi-trash-fill"></i></button>
          </a>


      </tr>


    <?php endforeach; ?>



  </tbody>
</table>
<script src="/vendors/dash/js/adminlte.js"></script>

</html>