<?php
$lista = array();

$produtos = array(
    array('nome' => 'Cadeira', 'descricao' => 'Cadeira de escritório', 'valor' => 'R$ 200,00', 'imagem' => 'itens/itens_loja/Cadeira_Escritorio_1.jpg'),
    array('nome' => 'Mesa', 'descricao' => 'Mesa de escritório', 'valor' => 'R$ 300,00', 'imagem' => '../img/Backgraund2.jpg'),
    array('nome' => 'Mesa', 'descricao' => 'Mesa de escritório', 'valor' => 'R$ 400,00', 'imagem' => '../img/baner_fofo.jpg'),
    array('nome' => 'Mesa', 'descricao' => 'Mesa de escritório', 'valor' => 'R$ 500,00', 'imagem' => '../img/Backgraund2.jpg'),
    array('nome' => 'Mesa', 'descricao' => 'Mesa de escritório', 'valor' => 'R$ 600,00', 'imagem' => '../img/Backgraund2.jpg'),
    array('nome' => 'Mesa', 'descricao' => 'Mesa de escritório', 'valor' => 'R$ 700,00', 'imagem' => '../img/Backgraund2.jpg')
);

// Shuffle the array of products
shuffle($produtos);

$lista = array();

// Select the first $quant_produtos items from the shuffled array
for ($i = 0; $i < $quant_produtos; $i++) {
    $lista[] = $produtos[$i];
}
?>
