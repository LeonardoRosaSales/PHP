<div class="container">
    <a href="<?php echo BASE_URL ?>contatos/add" class="btn btn-secondary mt-3">Adicionar contato</a>
</div>
<!-- Listagem - Início -->
<table class="table text-center table-bordered-m3">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody class="table-group-divider align-middle">
    
    <?php foreach ($lista as $item): ?>
    
    <tr>
      <th scope="row"><?php echo $item['id']; ?></th>
      <td><?php echo $item['nome']; ?></td>
      <td><?php echo $item['email']; ?></td>
      <td>
        <a href="<?php echo BASE_URL ?>contatos/edit/<?php echo $item['id']; ?>" class="btn btn-primary mt-3">Editar</a>
        <a href="<?php echo BASE_URL ?>contatos/del/<?php echo $item['id']; ?>" class="btn btn-danger mt-3">Deletar</a>
      </td>
    </tr>

    <?php endforeach; ?>

  </tbody>
</table>
<!-- Listagem - Fim -->