<!DOCTYPE html>
<?php
//FILTER_VALIDATE_EMAIL - Filtra se usuário esta enviando realmente um email ou algum outro formato errado, ou item malicioso.

//O filter_input() - podemos dizer que é uma junção das variáveis já conhecidas por nós programadores de PHP ($_POST, $_GET e outras) em uma única função, e "opcionalmente ela filtra e puxa informações armazenadas em variáveis externas(de arquivos,pastas externos)".

//INPUT_POST - é a forma que está sendo enviado do formulário, se for o caso colocar INPUT_GET


require '../CRUD_DB.php';

$id = filter_input(INPUT_POST, 'id');//para puxar o id que está sendo enviado pelo input anônimo no arquivo editar.php, e o 'id' vem do name="id" desse input. 
$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
// $senha = filter_input(INPUT_POST, 'senha');


//crud nome da tabela que é para inserir/verificar os dados.
if($id && $name && $email) {
//query de atualização/alterar em SQL - UPDATE crud SET name="..", email=".." WHERE id=".." - importante frizar que eu não altero o id, apenas preciso dele para usar como referência ao usuário, abaixo como fica essa query em código.

  $sql = $conectar->prepare("UPDATE crud SET nome = :name, email = :email WHERE id = :id");

  $sql->bindValue(':name', $name);//trocar/atualizar os dados
  $sql->bindValue(':email', $email);
  $sql->bindValue(':id', $id); 
  $sql->execute();  
  
  header("Location:R_do_CRUD_Ler_ConsultarDados.php"); 
  exit; //dados atualizados com sucesso, usuário volta para o index.

}else{
    header("Location:../adicionar.php");
    exit;
}

//bindValue(':name', $name); - primeiro passo oque eu quero substituir: ':name'; e depois informo oque vai substituir: $name. Então nesse caso o valor que está armazenado na variavel $name vai substituir o :name que nada mais é do que o name do input no front end, então resumidamente esse valor vindo da variavel $name vai ser armazenado no input name do front, atravez do bindValue();

