<?php
//FILTER_VALIDATE_EMAIL - Filtra se usuário esta enviando realmente um email
require 'CRUD_DB.php';

//O filter_input() podemos dizer que é uma junção das variáveis já conhecidas por nós programadores de PHP ($_POST, $_GET e outras) em uma única função, e "opcionalmente ela filtra e puxa informações armazenadas em variáveis externas(de arquivos,pastas externos)".
//INPUT_POST é a forma que está sendo enviado do formulário, se for o caso colocar INPUT_GET

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
// $senha = filter_input(INPUT_POST, 'senha');


//verificar se nome e email estão certos com o DB, caso contrário será redireconado para a tela adicionar.php

//se tiver nome e email.... Se Não tiver volte para a página adicionar.php e exit para finalizar.
//crud nome da tabela que é para inserir/verificar dados os dados.
if($name && $email){

//primeiro verificar se email que está chegando ja foi cadastrado anteriormente ou não, caso não, verificar se tem email chegando e cadastrar:

    $sql = $conectar->prepare("SELECT * FROM crud WHERE email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();

    if ($sql->rowCount() === 0){
 $sql = $conectar->prepare("INSERT INTO crud (nome, email) VALUES (:name, :email)");
 $sql->bindValue(':name', $name);//valor de :name será alterado pelo oque está em $name
 $sql->bindValue(':email', $email);//mesma coisa,$email vai inserir um valor em :email
 $sql->execute(); //executando a query criada acima  (pdo standment)

    header("Location: index/R_do_CRUD_Ler_ConsultarDados.php");
    exit;
} else {
    header("Location: adicionar.php");
    exit;
 }
}else{
    header("Location: adicionar.php");
}

//bindValue(':name', $name); - primeiro passo oque eu quero substituir: ':name'; e depois informo oque vai substituir: $name. Então nesse caso o valor que está armazenado na variavel $name vai substituir o :name que nada mais é do que o name do input no front end, então resumidamente esse valor vindo da variavel $name vai ser armazenado no input name do front, atravez do bindValue();