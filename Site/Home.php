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
    <style> <?php include_once 'css/Home.css'; ?>     
    </style>
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
    <div class="top">
        <div class="logo">
            <img src="../img/baner_fofo.jpg" alt="Logo">
        </div>
        <div class="pesquisa">
            <form action="Pesquisa.php" method="POST">
                <input type="text" name="pesquisa" placeholder="Pesquisar">
                <input type="submit" value="Pesquisar">
            </form>
        </div>
    </div>    
    <div class="content">
        <header>
            <h1>Home</h1>
            <?php
            //le todas as informaçoes do banco de dados
            $sql = "SELECT * FROM produtos";
            $result = mysqli_query($conexao, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['ID_produto'];
                    $nome_produto = $row['Nome'];
                    $quantidade = $row['Quantidade'];
                    $preco = $row['Preco'];
                    $img = $row['Img'];
                    if($img == "SemImagem.jpg"){
                        $img = "../img/SemImagem.jpg";
                    }else{
                        $img = "Estoque/Produtos/$img";
                    }
                    echo "<div class='produto'>";
                    echo "<p>$img</p>";
                    echo "<img src='$img' alt='Imagem do produto'>";
                    echo "<h2>$nome_produto</h2>";
                    echo "<p>Quantidade: $quantidade</p>";
                    echo "<p>Preço: R$ $preco</p>";
                    echo "<a href='../Site/Estoque/Comprar.php?id=$id'>Comprar</a>";
                    echo "</div>";

                }
            }

            ?>
        </header>
    </div>
</body>
</html>