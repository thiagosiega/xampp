<?php

include_once("Server/Server.php");

$Nome = $_POST['nome'];
$Sobrenome = $_POST['sobrenome'];
$Email = $_POST['email'];
$Senha = $_POST['senha'];
$Senha = password_hash($Senha, PASSWORD_DEFAULT); // Use password_hash
$Sexo = $_POST['sexo'];
$Data = $_POST['data'];

// Verifique se o e-mail já existe usando uma declaração preparada
$verificar = mysqli_prepare($conexao, "SELECT Email FROM users WHERE Email = ?");
mysqli_stmt_bind_param($verificar, "s", $Email);
mysqli_stmt_execute($verificar);
mysqli_stmt_store_result($verificar);

if(mysqli_stmt_num_rows($verificar) > 0){
    echo "<script>alert('Email já cadastrado!');window.location.href='index.php';</script>";
} else {
    $sql = "INSERT INTO users (Nome, Sobrenome, Email, Senha, Sexo, Data) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $Nome, $Sobrenome, $Email, $Senha, $Sexo, $Data);
    $resultado = mysqli_stmt_execute($stmt);
    
    if($resultado){
        header("Location: index.php");
        exit();
    } else {
        $erro = 3;
        header("Location: Erro.php?msg=$erro");
        exit();
    }
}

exit();
?>
