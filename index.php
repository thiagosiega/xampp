<?php
session_start();

if (isset($_SESSION['email'])) {
    include_once("Server/Server.php");

    // Check if the user exists
    $verificarUser = mysqli_prepare($conexao, "SELECT Nome, img FROM users WHERE email = ?");
    mysqli_stmt_bind_param($verificarUser, "s", $_SESSION['email']);
    mysqli_stmt_execute($verificarUser);
    mysqli_stmt_store_result($verificarUser);

    if (mysqli_stmt_num_rows($verificarUser) > 0) {
        mysqli_stmt_bind_result($verificarUser, $Nome, $img);
        mysqli_stmt_fetch($verificarUser);

        // Adjust the image path if needed
        $img = ($img != "img/Backgraund1.jpg") ? "Site/img_troca/".$img : $img;
    } else {
        // Redirect with error code if user doesn't exist
        $erro = 4;
        header("Location: Erros/Codigo_erro.php?msg=$erro");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Styles/login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php if (isset($_SESSION['email'])): ?>
        <div class="autologin">
            <div class="circle">
                <h1>Olá, <?php echo $Nome; ?></h1>
                <img src="<?php echo $img; ?>" alt="Foto de perfil">
                <a href="Site/Home.php">Entrar</a>
                <a href="Server/Logout.php">Sair</a>
            </div>
        </div>
    <?php endif; ?>
   <?php if (!isset($_SESSION['email'])): ?>
        <form action="Login.php" method="POST">
            <div class="box">
                <h1>Login</h1>
                <input type="text" name="email" placeholder="E-Mail">
                <input type="password" name="senha" placeholder="Senha">
                <input type="submit" value="Entrar">
                <a href="Cadastro.html">Cadastrar</a>
            </div>
        </form>
    <?php endif; ?>
</body>
</html>
