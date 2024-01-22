<?php

$lista_erros = [
    $erro = 1 => "Erro ao conectar com o banco de dados",
    $erro = 2 => "Erro ao cadastrar",
    $erro = 3 => "Opis, algo deu errado, parece que voce nao esta logado",
    $erro = 4 => "Erro ao acessar pagina",
    $erro = 5 => "Informaçoes invalidas",
    $erro = 6 => "Erro ao alterar",
    $erro = 7 => "Erro ao excluir",
    $erro = 8 => "Opis essa pagina exige login",
];

$msg = $lista_erros[$erro];

header("Location: Erro.php?msg=$msg")

?>
