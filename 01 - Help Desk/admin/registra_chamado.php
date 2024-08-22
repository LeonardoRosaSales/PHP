<?php

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

session_start();

// $texto = $_POST['titulo'] . $_POST['categoria'] . $_POST['descricao'];

$titulo = str_replace('#', '-', $_POST['titulo']);
$categoria = str_replace('#', '-', $_POST['categoria']);
$descricao = str_replace('#', '-', $_POST['descricao']);

$texto = $_SESSION['id'] . '#' . $titulo . '#' . $categoria . '#' . $descricao . PHP_EOL;

// echo $texto;

//Abrir o arquivo
$arquivo = fopen('arquivo.txt', 'a');

//Escreva o texto no arquivo
fwrite($arquivo, $texto);

//Fechando arquivo
fclose($arquivo);

//Redirencionar
header('Location: abrir_chamado.php');