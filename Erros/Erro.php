<?php
$msg = isset($_GET['msg']) ? $_GET['msg'] : "Erro desconhecido, tente novamente mais tarde.";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ops! tivemos um probleminha</title>
    <link rel="stylesheet" href="Style/Erro.css">
</head>
<body>
    <div class="container">
        <h1>Opis! temos ums problema!</h1>
        <div class = msg>
            <p><?php echo $msg; ?></p>
            <a href="../index.php">Voltar para a pagina inicial</a>
        </div>        
    </div>  
</body>
</html>
