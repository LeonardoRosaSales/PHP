<?php
require_once "config.php";

if (!empty($_POST['txt_cardapio'])) {
    $cardapio = $_POST['txt_cardapio'];
    $foto = $_FILES['file_foto']['name'];

    $foto = str_replace(" ", "", $foto);

    //Caminho Temporário
    $foto_temp = $_FILES['file_foto']['tmp_name'];
    $destino = "img/" . $foto;
}

//Cadastrar
if (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar') {
    if (move_uploaded_file($foto_temp, $destino)) {
        $insert = $pdo->prepare("INSERT INTO cardapios (cardapio, foto) VALUE(?,?)");
        $insert->bindValue(1, $cardapio);
        $insert->bindValue(2, $foto);
        $insert->execute();

        header("Location: pgCardapio.php");
    }
}

//Excluir
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    // echo "Cardápio excluído: id=" . $_GET['id'] . "<br>Fotos: " . $_GET['foto'];

    $id = $_GET['id'];
    $foto = $_GET['foto'];

    $del = $pdo->prepare("DELETE FROM cardapios WHERE idcardapio = ?");
    $del->bindValue(1, $id);
    $del->execute();

    unlink('img/' . $foto);

    header("Location: pgCardapio.php");
}

// echo "Cardápio: " . $cardapio . "<br> Foto: " . $foto;

//Editar
if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
    $id = $_GET['id'];
    $fotodb = $_GET['foto'];

    //teste
    if ($_FILES['file_foto']['size'] == 0) {
        // echo 'Sem foto';
        $edit = $pdo->prepare("UPDATE cardapios SET cardapio = ? WHERE idcardapio = ?");
        $edit->bindValue(1, $cardapio);
        $edit->bindValue(2, $id);
        $edit->execute();

        header("Location: pgCardapio.php");
    } else {
        // echo 'Com foto';
        unlink('img/'. $fotodb);

        if (move_uploaded_file($foto_temp, $destino)) {
            $edit = $pdo->prepare("UPDATE cardapios SET cardapio = ?, foto = ? WHERE idcardapio = ?");
            $edit->bindValue(1, $cardapio);
            $edit->bindValue(2, $foto);
            $edit->bindValue(3, $id);
            $edit->execute();
    
            header("Location: pgCardapio.php");
        }
    }
}