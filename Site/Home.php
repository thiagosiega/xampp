<?php
session_start();
if(!isset($_SESSION['email'])){
    $erro = 4;
    header("Location: ../Erros/Codigo_erro.php?$erro");
    exit();
}

include_once("../Server/Server.php");

//verifica as informações do usuário
$verificar = mysqli_prepare($conexao, "SELECT Nome FROM users WHERE email = ?");
mysqli_stmt_bind_param($verificar, "s", $_SESSION['email']);
mysqli_stmt_execute($verificar);
mysqli_stmt_store_result($verificar);

//se o usuário existir
if (mysqli_stmt_num_rows($verificar) > 0) {
    //usando o nome do usuário coleto as informações do mesmo
    mysqli_stmt_bind_result($verificar, $Nome);
    mysqli_stmt_fetch($verificar);
    // coleto as informações do usuário Nome, Email, Senha, Data de nascimento, Sexo, img
    $verificar = mysqli_prepare($conexao, "SELECT Nome, Email, Senha, Data, Sexo, img FROM users WHERE email = ?");
    mysqli_stmt_bind_param($verificar, "s", $_SESSION['email']);
    mysqli_stmt_execute($verificar);
    mysqli_stmt_store_result($verificar);
    mysqli_stmt_bind_result($verificar, $Nome, $Email, $Senha, $Data, $Sexo, $img);
    mysqli_stmt_fetch($verificar);
    //adiciona"../" para acessar a pasta onde está a imagem
    //verifica se o camiho da imagem é padrao
    if($img == "Backgraund1.jpg"){
        $img = "../".$img;
    }else{
        $img = "img_troca/".$img;
    }

    
} else {
    $erro = 4;
    header("Location: ../Erros/Codigo_erro.php?$erro");
    exit();
}


$quant_produtos = 3;
include_once("itens/gerente_itens.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link type="text/css" rel="stylesheet" href="Style/Home.css"> 
</head>
<body>
    <div class="slide">
        <div class="titulo">
            <h1>Produtos</h1>
        </div>
            <?php
            for ($i = 0; $i < $quant_produtos; $i++) {
                echo "<div class='product'>";
                echo "<div class='slide_img'><br>";
                echo "<img src='" . $lista[$i]['imagem'] . "' alt=''>";
                echo "</div>";
                echo "<div class='slide_text'><br>";
                echo "<h1>" . $lista[$i]['nome'] . "</h1>";
                echo "<p>" . $lista[$i]['descricao'] . "</p>";
                echo "<h2>" . $lista[$i]['valor'] . "</h2>";
                echo "<a href='#'>Comprar</a>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <div class="siderbar">
        <div class="img">
            <img src="<?php echo $img; ?>" alt="Foto de perfil"><br>
        </div>
        <h1><?php echo $Nome; ?></h1>
        <div class="atalhos">
            <a href="Home.php">Home</a>
            <a href="Perfil.php">Perfil</a>
            <a href="Carrinho.php" name="sair">Carrinho</a>
            <a href="../Server/Logout.php">Sair</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sidebar = document.querySelector(".siderbar");

            // Inicia ocultando o sidebar
            sidebar.style.left = "-300px"; // Move a sidebar para fora da tela

            function sair() {
                var sair = confirm("Deseja realmente sair?");
                if (sair == true) {
                    window.location.href = "../Server/Logout.php";
                }
            }

            function esconder(event) {
                var sidebarWidth = sidebar.offsetWidth;

                if (event.clientX < 20) {
                    sidebar.style.left = "0";
                } else if (event.clientX > sidebarWidth + 20) {
                    sidebar.style.left = "-300px";
                }
            }

            document.addEventListener('mousemove', esconder);
        });
    </script>
   
</body>
</html>