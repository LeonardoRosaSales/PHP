<?php
require_once 'config.php';
require_once 'menu.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="container mt-3">
        <!-- Botão Modal Cadastro - Início -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCadastro">
            Adicionar Prato
        </button>

        <!-- Modal Cadastro -->
        <div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Prato</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="opPrato.php?acao=cadastrar" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Prato</label>
                                <input type="text" class="form-control" name="txt_prato"
                                    placeholder="Digite o nome do Prato">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Selecione o Cardápio</label>
                                <select class="form-select" name="txt_cardapio">
                                    <?php
                                    $sql = $pdo->query("SELECT * FROM cardapios ORDER BY cardapio");

                                    while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
                                        
                                    ?>
                                    <option value="<?php echo $linha['idcardapio']?>"><?php echo $linha['cardapio']?></option>

                                    <?php } ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto</label>
                                <input class="form-control" type="file" name="file_foto">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Listagem Início -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Prato</th>
                    <th scope="col">Cardápio</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $lista = $pdo->query("SELECT p.idprato, p.prato, p.foto, c.cardapio, c.idcardapio FROM pratos p INNER JOIN cardapios c ON p.idcardapio = c.idcardapio");

                while ($linha = $lista->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <tr>
                        <th scope="row"><?php echo $linha['idprato'] ?></th>
                        <th><?php echo $linha['prato'] ?></th>
                        <td><?php echo $linha['cardapio'] ?></td>
                        <td>
                            <img src="img/<?php echo $linha['foto'] ?>" width="100px" alt="">
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditar<?php echo $linha['idprato'] ?>">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalExcluir<?php echo $linha['idprato'] ?>">
                                Excluir
                            </button>
                        </td>
                    </tr>
                    <!-- Modal Excluir - Início-->
                    <div class="modal fade" id="modalExcluir<?php echo $linha['idprato'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja excluir o Prato?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <a href="opPrato.php?acao=excluir&id=<?php echo $linha['idprato'] ?>&foto=<?php echo $linha['foto'] ?>"
                                        class="btn btn-primary">Sim</a>
                                    <button class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Excluir - Fim-->
                    <!-- Modal Editar - Início-->
                    <div class="modal fade" id="modalEditar<?php echo $linha['idprato'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja editar o Prato?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="opPrato.php?acao=editar&id=<?php echo $linha['idprato'] ?>&foto=<?php echo $linha['foto'] ?>"
                                        method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Prato</label>
                                            <input type="text" class="form-control" name="txt_prato"
                                                placeholder="Digite o nome do Prato" value="<?php echo $linha['prato'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Foto</label>
                                            <input class="form-control" type="file" name="file_foto">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar - Fim-->
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!-- Listagem Fim -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>