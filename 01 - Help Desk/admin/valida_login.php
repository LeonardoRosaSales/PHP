<?php
    // echo 'Teste Ok!';

    // print_r($_GET);

    // echo '<br>';
    // echo $_GET['email'];
    // echo '<br>';
    // echo $_GET['senha'];

    // print_r($_POST);

    // echo '<br>';
    // echo $_POST['email'];
    // echo '<br>';
    // echo $_POST['senha'];

    session_start();

    $usuario_autenticado = false;
    $usuario_id = null;

    $usuarios_app = array(
        array('id' => 1, 'email' => 'adm@teste.com.br', 'senha' => '1234'),
        array('id' => 2, 'email' => 'user@teste.com.br', 'senha' => '1234'),
        array('id' => 3, 'email' => 'leo@leo.com.br', 'senha' => '1234')
    );

    foreach ($usuarios_app as $user) {
      if($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']){
        $usuario_autenticado = true;
        $usuario_id = $user['id'];
      };
    };

    if($usuario_autenticado){
        // echo 'Usuário autenticado com sucesso!';

        $_SESSION['autenticado'] = 'SIM';
        $_SESSION['id'] = $usuario_id;
        header('Location: home.php');
    }else{
        // echo 'Erro de Auteticação';
        
        $_SESSION['autenticado'] = 'NÃO';
        header('Location: index.php?login=erro');
    };
?>