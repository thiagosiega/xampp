<?php 

//file : Admim/Admim.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
}
include_once '../Server/Server.php';
include_once '../Server/Verificar.php';

if ($id != 3) {
    header('location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso adiminstrativo: <?php echo $nome ?></title>
    <style>
        <?php include_once 'css/Admim.css'; ?>
    </style>
</head>
<body>
    <div class="container">
        <div class="Funcionarios" id="Funcionarios">
            <h1>Funcionarios</h1>
            <?php 
                $sql = "SELECT * FROM funcionarios";
                $result = mysqli_query($conexao, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0) {
                    // Início da tabela
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Nível</th><th>Salário</th></tr>"; // Cabeçalho da tabela

                    while ($row = mysqli_fetch_assoc($result)) {
                        // Linha da tabela para cada funcionário
                        echo "<tr><td>".$row['ID']."</td><td>".$row['Nome']."</td><td>".$row['Email']."</td><td>".$row['Lev']."</td><td>".$row['Salario']."</td></tr>";
                    }

                    // Fim da tabela
                    echo "</table>";
                } else {
                    echo "<p>Nenhum funcionario cadastrado!</p>";
                }

                if (isset($_GET['error'])) {
                    // Mensagens de erro
                    if ($_GET['error'] == 'emptyfields') {
                        echo '<p class="error">Preencha todos os campos!</p>';
                    }
                    if ($_GET['error'] == 'sqlerror') {
                        echo '<p class="error">Erro no banco de dados!</p>';
                    }
                }
            ?>
        </div>
        <div class="Adicionar" id="Adicionar_funcionarios">
            <h1>Adicionar</h1>
            <form action="../Server/Admim.php" method="post" name="Adicionar">
                <p>Nome do Funcionario</p>
                <input type="text" name="nome" placeholder="Nome">
                <p>Email do Funcionario</p>
                <input type="email" name="email" placeholder="Email">
                <p>Senha do Funcionario</p>
                <input type="text" id="senha" name="senha" placeholder="Senha">
                <button type="button" onclick="gerarSenha()">Gerar Senha</button>
                <script>
                    function gerarSenha() {
                        var senha = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
                        document.getElementById('senha').value = senha;
                    }
                </script>
                <p>Nivel de acesso do funcionario</p>
                <select name="nivel">
                    <option value="1">Funcionario</option>
                    <option value="2">Gerente</option>
                    <option value="3">Admim</option>
                </select>
                <p>Salario do funcionario (Sem o cifrão "$")</p>
                <input type="text" name="salario" placeholder="Salario">
                <button type="submit" name="submit">Adicionar</button>
            </form>
        </div>
        <div class="Remover" id="Remover_Funcionarios">
            <h1>Remover</h1>
            <form action="../Server/Admim.php" method="post" nome="Remover">
                <p>Nome do Funcionario</p>
                <input type="text" name="nome" placeholder="Nome">
                <p>Email do Funcionario</p>
                <input type="email" name="email" placeholder="Email">
                <p>ID do funcionario</p>
                <input type="text" name="ID" placeholder="ID">
                <button type="submit" name="submit2">Remover</button>
            </form>
            <script>
                function confirmarRemocao() {
                    return confirm('Deseja excluir o funcionario?');
                }
            </script>
        </div>
        <div class="Produtos" id="Produtos">
            <h1>Produtos</h1>
            <?php 
                $sql = "SELECT * FROM produtos";
                $result = mysqli_query($conexao, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0) {
                    // Início da tabela
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Nome</th><th>Quantidade</th><th>Preço</th></tr>"; // Corrigido: Removido o <th> vazio
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Linha da tabela para cada produto
                        echo "<tr><td>".$row['ID_produto']."</td><td>".$row['Nome']."</td><td>".$row['Quantidade']."</td><td>".$row['Preco']."</td></tr>";
                    }

                    // Fim da tabela
                    echo "</table>";
                } else {
                    echo "<p>Nenhum Item cadastrado!</p>";
                }
            ?>

        </div>
        <div class="Adicionar" id="Adicionar_Produtos" >
            <h1>Adicionar</h1>
            <form action="../Server/Admim.php" method="post" nome="Adicionar" enctype="multipart/form-data">
                <p>Nome do Produto</p>
                <input type="text" name="nome" placeholder="Nome">
                <p>Preço do Produto</p>
                <input type="text" name="preco" placeholder="Preço">
                <p>Quantidade do Produto</p>
                <input type="text" name="quantidade" placeholder="Quantidade">
                <p>Imagem do Produto</p>
                <input type="file" name="imagem" placeholder="Imagem">
                <button type="submit" name="submit3">Adicionar</button>
            </form>
        </div>
        <div class="Remover" id="Remover_Produtos">
            <h1>Remover</h1>
            <form action="../Server/Admim.php" method="post" id="Remover">
                <p>ID do Produto</p>
                <input type="text" name="ID" placeholder="ID">
                <button type="submit" name="submit4">Remover</button>
            </form>
        </div>
    </div>
    <div class="navbar-bottom">
        <a href="#Funcionarios" class="scroll-link">Tabela Funcionarios</a>
        <a href="#Adicionar_funcionarios" class="scroll-link">Adicionar Funcionarios</a>
        <a href="#Remover_Funcionarios" class="scroll-link">Remover Funcionarios</a>
        <a href="#Produtos" class="scroll-link">Taela de Produtos</a>
        <a href="#Adicionar_Produtos" class="scroll-link">Adicionar Produtos</a>
        <a href="#Remover_Produtos" class="scroll-link">Remover Produtos</a>
        <a href="../Server/Logout.php">Sair</a>
        <a href="../Site/Home.php">Home</a>
        <!-- Adicione mais links conforme necessário -->
    </div>
    <script>
        // JavaScript para permitir a rolagem suave para os links da barra de navegação
        document.addEventListener("DOMContentLoaded", function () {
        var scrollLinks = document.querySelectorAll('.scroll-link');

        for (var i = 0; i < scrollLinks.length; i++) {
            scrollLinks[i].addEventListener('click', function(event) {
            event.preventDefault();
            var section = document.querySelector(this.getAttribute('href'));
            section.scrollIntoView({ behavior: 'smooth' });
            });
        }
        });

    </script>
</body>
</html>