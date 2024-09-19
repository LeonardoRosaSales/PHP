<div class="container mt-3">
    <h3>Editar</h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nome: </label>
            <input type="text" class="form-control" name="nome" value="<?php echo $info['nome'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email: </label>
            <input type="email" class="form-control" name="email" value="<?php echo $info['email'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>