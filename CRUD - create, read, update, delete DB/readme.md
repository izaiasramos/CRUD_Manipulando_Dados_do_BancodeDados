Este projeto consiste por em prática os seguintes conhecimentos adquiridos:

PDO - conexão com o banco de dados utilizando a biblioteca pdo

- está no arquivo: CRUD_DB.php


arquivo: adicionar.php

tenho um formulário com inputs aonde o usuário vai inserir o nome e o email e esse formulário é enviado via POST para o arquivo: adicionar_action.php aonde lá fizemos o tratamento desses dados que vem desses inputs.

arquivo: adicionar_action.php

- aqui tenho as duas variaveis $nome e $email, onde vou trabalhar em cima delas para fazer o tratamento dos dados.

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

- coloco esses filter_input para puxar os dados que o usuário vai inserir no input.
- informo que o modo de envio será via POST.


if($name && $email){
}

 Crio um if para:

- verificar se o usuário realmente digitou algo, caso contrario será redirecionado a mesma tela header("adicionar.php"); e exit; para finalizar a requisição.

Mas a primeira coisa que faço dentro do if é:

  $sql = $conectar->prepare("SELECT * FROM crud WHERE email = :email");
  $sql->bindValue(':email', $email);
  $sql->execute();

  um tratamento para verificar se email que está chegando ja foi cadastrado anteriormente ou não, caso não, verificar se tem email chegando e cadastrar:

  $sql = $conectar->prepare("SELECT * FROM crud WHERE email = :email");
  - selecione toda a tabela crud e verifica se email enviado é igual a algum registro de email cadastrado na tabela crud (para evitar duplicidade, que o usuário cadastre novamente o mesmo email).

   $sql->bindValue(':email', $email);

    - bindValue() é uma função que pega os dados que entra na variável e insere no input name, como nesse caso :email', $email <- a variável vai inserir dados na :email e tudo isso vai ser armazanado na variável $sql que vai atravez da query jogar para o DB.

    $sql->execute(); 
     
     - tem a função de executar, nesse caso essa função vai executar a query criada acima dela.


aqui começo a query para salvar os dados digitados pelo usuario no meu Banco de Dados usandocrudepdo mais especificamente na tabela crud:

         if ($sql->rowCount() === 0){ //vai em $sql e conta as linhas,se tem mais do que 0, caso tenha faça
 $sql = $conectar->prepare("INSERT INTO crud (nome, email) VALUES (:name, :email)"); //:name e :email sobrescrevendo nome e email do banco de dados
 $sql->bindValue(':name', $name);//valor de :name será alterado pelo oque está em $name
 $sql->bindValue(':email', $email);//mesma coisa,$email vai inserir um valor em :email
 $sql->execute(); //executando a query criada acima  (pdo standment)

    header("Location: R_do_CRUD_Ler_ConsultarDados.php"); //se dados forem salvos redicionar usuario 
    exit; //fim da requisição

if ($sql->rowCount() === 0){ 
  - vai em $sql e conta as linhas(rowCount()),se tem mais do que 0, caso tenha faça{
    
$sql = $conectar->prepare("INSERT INTO crud (nome, email) VALUES (:name, :email)"); 
  - :name e :email sobrescrevendo nome e email do banco de dados, é aqui que os dados são sobrescritos no DB

$sql->bindValue(':name', $name);//valor de :name (input) será alterado pelo oque está em $name
$sql->bindValue(':email', $email);//mesma coisa,$email vai inserir um valor em :email
$sql->execute(); //executando a query criada acima  (pdo standment)

  }


ARQUIVO/PASTA : R_do_CRUD_Ler_ConsultarDados.php (página index):

   fetchALL - a diferença entre o fetch e o fetchAll está no retorno. No caso do fetch é um array simples, enquanto no fetchAll é um array multidimensional, também chamado de matriz. Na sua situação está dando certo o fetch por que só tem um registro no banco, a partir do momento que tiver mais de um registro no banco, ele irá lançar um PDOException, pois está recebendo mais de um objeto do banco enquanto só suporta um, a não ser que use um LIMIT 0,1 em sua consulta, porém assim só trará um resultado do banco e não acredito que seja isso que está precisando. Para isso você teria de usar o fetchAll e para imprimir na tela teria de usar o foreach, ficaria assim o código:

foreach($codigos as $item)
{
   echo $item["codigo"];
}