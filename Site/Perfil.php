<?php 

session_start();
if(!isset($_SESSION['email'])){
    header('location:../index.php');
    exit();
}

include_once '../Server/Server.php';

include_once '../Server/Verificar.php';


?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/Perfil.css">
    <title>Home</title>
    <style>
        <?php include_once 'css/Perfil.css'; ?>
    </style>
</head>
<body>
    <div class="siderbar" id="mySidebar">
        <h1>Ola!<br><?php echo $nome?></h1> 
        <div class="imagem">  
            <img src="<?php echo $img?>" alt="perfil" class="perfil">
        </div>
        <div class="atalhos">
            <a href="Home.php">Home</a>
            <a href="Perfil.php">Perfil</a>
            <a href="../Server/Logout.php">Sair</a>
        </div>  
    </div>
    <div class="content">
        <div class="tex_infor">
            <h1>Informações</h1>
            <div class="infor">
                <div class="nome">
                    <h2>Nome:</h2>
                </div>
                <div class="sobrenome">
                    <h2>Sobrenome: </h2>
                </div>
                <div class="email">
                    <h2>Email:</h2>
                </div>
                <div class="sexo">
                    <h2>Sexo:</h2>
                </div>
                <div class="data">
                    <h2>Data de Nascimento:</h2>
                </div>
            </div>
        </div>
        <div class="tex_infor2">
            <br><br><br>
            <div class="infor2">
                <div class="nome">
                    <h2><?php echo $nome?></h2>
                </div>
                <div class="sobrenome">
                    <h2><?php echo $sobrenome?></h2>
                </div>
                <div class="email">
                    <h2><?php echo $email?></h2>
                </div>
                <div class="sexo">
                    <h2><?php echo $sexo?></h2>
                </div>
                <div class="data">
                    <h2><?php echo $data?></h2>
                </div>
            </div>
        </div>        
    </div>
    <div class = "img_perfil">
        <h1>Imagem de Perfil</h1>
        <div class="imagem">  
            <div class="img_perfil_exibir">
                <img src="<?php echo $img?>" alt="perfil" class="perfil">
            </div>
            <form action="troca_perfil.php" method="post" enctype="multipart/form-data">
                <input type="file" name="img">
                <input type="submit" value="Upload">
            </form>
        </div>
    </div>
</body>
</html>