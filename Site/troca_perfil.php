<?php  

session_start();
if(!isset($_SESSION['email'])){
    $erro = 3;
    header("Location: ../Erros/Codigo_erro.php?msg=$erro");
    exit();
}

?>