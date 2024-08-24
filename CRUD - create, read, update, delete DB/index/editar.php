<?php
require '../CRUD_DB.php';//importante ter o arquivo de conexão com o banco, para permitir consultas.

$info = [];//uma variavel array vazio que vai ter informações do usuário. 
$id = filter_input(INPUT_GET, 'id');//consulta para receber/puxar o id do banco de dados
if($id){//verificar se foi enviado algum dado á $id, caso sim faça{}

$sql = $conectar->prepare("SELECT * FROM crud where id = :id");//query para consultar/procurar id no Banco
$sql -> bindValue(':id', $id); //alterar o valor de :id por $id que o usuario digitou
$sql -> execute(); // sempre executar a query, caso contrario ela so irá preparar e não vai achar o dado desejado.

    if($sql->rowCount() > 0){//fazer verificação se achou o id no banco,preencher as info do usuar

        $info = $sql->fetch(PDO::FETCH_ASSOC);//método fetch busca apenas 1 item, fetchALL pega varios


    }else{ // caso nã ache o ID no banco
        header("Location:R_do_CRUD_Ler_consultarDados.php");
        exit; //finaliza a requisição
    }
}else{// caso não tenha id redirecionar usuário para a tela index
 header('Location: R_do_CRUD_Ler_consultarDados.php');
 exit; //fim da requisição
}
?>
<h2>Editar Usuário</h2>

<form method="GET" action="editar_action.php">
   <label>
        Nome: <br/>
         <input type="text" name="name" value="<?= $info['NOME']; ?>"/> <!--Muito importante ressaltar que ao apertar editar la no index, ao chegar nessa tela de editar os campos deveriam trazer os dados de cada campo salvo anteriormente no Banco, e isso só ocorre quando eu deixo a tag de abertura assim ->  < ? =  <- como está dentro do value="< ? = . . . ?>", Preencher array como está no DB ['NOME']  <-aqui mostro qual item da tabela crud quero exibir neste campo-->
   </label> <br/><br/>

   <label>
        Email: <br/> 
         <input type="text" name="email" value="<?= $info['EMAIL']; ?>"/><!--Colocar como está no DB['EMAIL'] Aqui informo qual item da tabela puxar para este campo --> 
   </label> <br/><br/>

   <label>
        Senha:   <br/>
         <input type="text" name="senha" value=""/>
   </label>  <br/><br/>

    <input type="submit" value="Salvar" />
</form>
