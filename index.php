<?php
//impede 2 sessões
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['email'])) {
    include_once("Server/Server.php");
    include_once("Server/Verificar.php");
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
                <h1>Olá, <?php echo $nome; ?></h1>
                <img src="<?php echo "Site/$img"; ?>" alt="Foto de perfil">
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
