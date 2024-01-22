<?php
session_start();
if(!isset($_SESSION['email'])){
    header('location:../index.php');
    exit();
}

include_once '../Server/Server.php';
//verifica se o email existe
include_once '../Server/Verificar.php';

?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link type="text/css" rel="stylesheet" href="css/Home.css">
</head>
<body>
    <div class="siderbar">
        <h1>Ola!<br><?php echo $nome?></h1> 
        <div class="imagem">  
            <img src="<?php echo $img?>" alt="Imagem de perfil">
        </div>
        <div class="atalhos">
            <a href="Home.php">Home</a>
            <a href="Perfil.php">Perfil</a>
            <a href="../Server/Logout.php">Sair</a>
        </div>  
    </div>    
    <div class="content">
        <header>
            <h1>Home</h1>
        </header>
    </div>
</body>
</html>