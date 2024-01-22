<?php
session_start();
if(!isset($_SESSION['email'])){
    header('location:../index.php');
    exit();
}

include_once '../Server/Server.php';
//verifica se o email existe
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 1) {
    $nome = $row['Nome'];
    $sobrenome = $row['Sobrenome'];
    $email = $row['Email'];
    $sexo = $row['Sexo'];
    $data = $row['Data'];
    $img = $row['img'];
    //
}

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
            <?php
                if($img == 1){
                    echo "<img src='User/$email/$img' alt='perfil' class='perfil'>";
                }else{
                    echo "<img src='../img/Perfil/Padrao.jpg' alt='perfil' class='perfil'>";
                }
            ?> 
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