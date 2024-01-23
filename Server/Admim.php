<?php  
// Inicia a sessão se ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redireciona se o usuário não estiver logado ou não tiver o nível de acesso correto
if (!isset($_SESSION['email'])){
    header('Location: ../index.php');
    exit();
}

include_once '../Server/Server.php';
include_once '../Server/Verificar.php';

//adiciona o funcionario

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {    // Verifica se os campos obrigatórios foram preenchidos
    if (empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["senha"])) {
        echo "Preencha todos os campos!";
        echo "<p><a href='../Admim/Admim.php'>Voltar</a></p>";
        exit();
    }
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $senha = $_POST["senha"]; // A senha deve ser hashada antes de ser armazenada
    $nivel = filter_input(INPUT_POST, "nivel", FILTER_SANITIZE_NUMBER_INT);
    $salario = filter_input(INPUT_POST, "salario", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $salario = "R$" . $salario;

    //verifica se o email ja esta cadastrado
    $sql = "SELECT Email FROM funcionarios WHERE Email = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    if ($resultCheck > 0) {
        echo "Email ja cadastrado!";
        echo "<p><a href='../Admim/Admim.php'>Voltar</a></p>";
        exit();
    }

    //verifica se a senha ja esta cadastrada
    $sql = "SELECT Senha FROM funcionarios WHERE Senha = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $senha);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    if ($resultCheck > 0) {
        echo "Senha ja cadastrada!";
        echo "<p><a href='../Admim/Admim.php'>Voltar</a></p>";
        exit();
    }

    // Insere o funcionário no banco de dados
    $sql = "INSERT INTO funcionarios (Nome, Email, Senha, Lev, Salario) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sssis", $nome, $email, $senha, $nivel, $salario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    echo "<script>alert('Funcionario adicionado com sucesso!');</script>";
    header("Location: ../Admim/Admim.php");

} 

//remove o funcionario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit2"])) {
    // Assume-se que $conexao é a sua conexão com o banco de dados e que já foi estabelecida.
    $ID = filter_input(INPUT_POST, "ID", FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    
    // Verifica se o ID é válido
    if (!is_numeric($ID)) {
        echo "ID inválido!";
        echo "<p><a href='../Admim/Admim.php'>Voltar</a></p>";
        exit();
    }

    // Verifica se o nome e email correspondem ao ID
    $sql = "SELECT * FROM funcionarios WHERE ID = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($row && $row['Nome'] == $nome && $row['Email'] == $email) {
        // Remove o funcionário do banco de dados
        $sql = "DELETE FROM funcionarios WHERE ID = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $ID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        header('Location: ../Admim/Admim.php'); // Redireciona após a remoção
    } else {
        echo "Nome ou email não correspondem ao ID!";
        echo "<p><a href='../Admim/Admim.php'>Voltar</a></p>";
    }
    exit();
}

//adiciona o produto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit3"])) {
    $nome_produto = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_NUMBER_INT);
    $preco = filter_input(INPUT_POST, "preco", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Verifica se o produto já está cadastrado
    $sql = "SELECT Nome FROM produtos WHERE Nome = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nome_produto);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    
    if ($resultCheck > 0) {
        echo "<script>alert('Produto já cadastrado!'); window.location.href='../Admim/Admim.php';</script>";
        exit();
    } else {
        // Insere o produto no banco de dados
        $sql = "INSERT INTO produtos (Nome, Quantidade, Preco) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sid", $nome_produto, $quantidade, $preco);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        echo "<script>alert('Produto adicionado com sucesso!'); window.location.href='../Admim/Admim.php';</script>";
        exit();
    }
}

//remove o produto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit4"])) {
    $ID_produto = filter_input(INPUT_POST, "ID", FILTER_SANITIZE_NUMBER_INT);
    // Verifica se o ID é válido
    if (!is_numeric($ID_produto)) {
        echo "ID inválido!";
        echo "<p><a href='../Admim/Admim.php'>Voltar</a></p>";
        exit();
    }
    else {
        // Remove o produto do banco de dados
        $sql = "DELETE FROM produtos WHERE ID_produto = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "i", $ID_produto);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        header('Location: ../Admim/Admim.php'); // Redireciona após a remoção
    }
}
else {
    echo "Erro ao identificar o botão!";
    exit();
}

?>
