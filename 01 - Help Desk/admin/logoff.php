<?php

session_start();

// unset($_SESSION['autenticado']);
// header('Location: index.php');

session_destroy();
header('Location: index.php');