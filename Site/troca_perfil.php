<?php  

//file > Site/troca_perfil.php

include_once "../Server/Verificar.php";

if ($_FILES['img']['error'] !== UPLOAD_ERR_OK) {
    die("Erro no upload: " . $_FILES['img']['error']);
}

//cria o diretorio
$file_img = "User/".$email."/img/";
if (!file_exists($file_img)) {
    //cria o diretorio
    mkdir($file_img, 0777, true);
}

//verifica se tem mais de uma imagem
if (count(glob($file_img."*")) > 1) {
    //deleta todas as imagens
    foreach (glob($file_img."*") as $file) {
        unlink($file);
    }
}
//criptografa o nome do arquivo
$nome_img = md5($_FILES['img']['name'].rand(1,999)).".jpg";

//atualiiza o banco de dados
$sql = "UPDATE users SET img = '$nome_img' WHERE email = '$email'";
$result = mysqli_query($conexao, $sql);
//move o arquivo para o diretorio
if (move_uploaded_file($_FILES['img']['tmp_name'], $file_img.$nome_img)) {
    //verifica se o nome da imagem é igual ao salvo no banco de dados
    if ($img != $nome_img) {
        //deleta a imagem antiga
        unlink($file_img.$img);
    }
    header('location: Perfil.php');
} else {
    echo "Erro ao enviar a imagem";
}

?>