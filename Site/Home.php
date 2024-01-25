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
        <div class="carrossel-container">
            <?php
            //le todas as informaçoes do banco de dados
            $sql = "SELECT * FROM produtos";
            $result = mysqli_query($conexao, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $quantidade_exibir = 5;
                    $nome = $row['Nome'];
                    $preco = $row['Preco'];
                    $imagem = $row['Img'];
                    $quantidade = $row['Quantidade'];
                    if ($imagem == "SemImagem.jpg") {
                        $imagem = "../img/SemImagem.jpg";
                    } else {
                        $imagem = "Estoque/Produtos/" . $imagem;
                    }

                    if ($quantidade > 0) {
                        echo "<div class='produtos'>";
                        echo "<img src='$imagem' alt='$imagem'>";
                        echo "<div class='info'>";
                        echo "<h2>$nome</h2>";
                        echo "<p>R$ $preco</p>";
                        echo "<p>Quantidade: $quantidade</p>";
                        echo "<form action='../Site/Adicionar.php' method='POST'>";
                        echo "<input type='hidden' name='nome' value='$nome'>";
                        echo "<input type='hidden' name='preco' value='$preco'>";
                        echo "<input type='hidden' name='imagem' value='$imagem'>";
                        echo "<input type='hidden' name='quantidade' value='$quantidade'>";
                        echo "<input type='number' name='quantidade_adicionar' min='1' max='$quantidade_exibir' value='1'>";
                        echo "<input type='submit' name='submit' value='Adicionar'>";
                        echo "</form>";
                        echo "</div>"; // Fechando a div 'info'
                        echo "</div>"; // Fechando a div 'produtos'
                    }
                }
            }
            ?>
        </div>
        <div class="Itens">
            <h1>Itens</h1>
            <div class="carrossel-total">
                <?php
                //le todas as informaçoes do banco de dados
                $sql = "SELECT * FROM produtos";
                $result = mysqli_query($conexao, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $nome = $row['Nome'];
                        $preco = $row['Preco'];
                        $imagem = $row['Img'];
                        $quantidade = $row['Quantidade'];
                        if ($imagem == "SemImagem.jpg") {
                            $imagem = "../img/SemImagem.jpg";
                        } else {
                            $imagem = "Estoque/Produtos/" . $imagem;
                        }
                        echo "<div class='produtos'>";
                        echo "<img src='$imagem' alt='$imagem'>";
                        echo "<div class='info'>";
                        echo "<h2>$nome</h2>";
                        echo "<p>R$ $preco</p>";
                        echo "<p>Quantidade: $quantidade</p>";
                        echo "<form action='../Site/Adicionar.php' method='POST'>";
                        echo "<input type='hidden' name='nome' value='$nome'>";
                        echo "<input type='hidden' name='preco' value='$preco'>";
                        echo "<input type='hidden' name='imagem' value='$imagem'>";
                        echo "<input type='hidden' name='quantidade' value='$quantidade'>";
                        echo "<input type='number' name='quantidade_adicionar' min='1' max='$quantidade_exibir' value='1'>";
                        echo "<input type='submit' name='submit' id='btn' value='Adicionar'>";
                        echo "</form>";
                        echo "</div>"; 
                        echo "</div>"; 
                        
                    }
                }
                ?>
            </div>
        </div>
    </header>
</div>

</body>
</html>