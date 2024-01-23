<?php  

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
}

include_once 'Server.php';
//verifica se o email existe
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) == 1) {
    $nome = $row['Nome'];
    $sobrenome = $row['Sobrenome'];
    $email = $row['Email'];
    $img = $row['img'];
    $sexo = $row['Sexo'];
    $data = $row['Data'];
    $id = $row['ID'];
    if ($img == "img/Backgraund1.jpg") {
        $img = "../$img";
    }else{
        $img = "User/$email/img/$img";
    }
}else{
    header('location: ../index.php');
}

?>