<?php
require '../CRUD_DB.php';//importante ter o arquivo de conexão com o banco, para permitir consultas.

$id = filter_input(INPUT_GET, 'ID');//consulta para receber/puxar o id do banco de dados
if($id){//verificar se foi enviado algum dado á $id, caso sim faça{}

$sql = $conectar->prepare("SELECT * FROM crud where id = :id");//query para consultar/procurar id no Banco
$sql -> bindValue(':id', $id); //alterar o valor de :id por $id que vai usuario digitou
$sql -> execute(); // sempre executar a query, caso contrario ela so irá preparar e não vai achar o dado desejado.

    if($sql->rowCount() > 0){//fazer verificação se achou o id no banco
        $sql = $conectar->prepare("INSERT INTO crud(ID) VALUES (:ID)");
        $sql->bindValue(":ID", $id);
        $sql->execute();
        
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
         <input type="text" name="name" value=""/>  
   </label> <br/><br/>

   <label>
        Email: <br/> 
         <input type="text" name="email" value=""/>
   </label> <br/><br/>

   <label>
        Senha:   <br/>
         <input type="text" name="senha" value=""/>
   </label>  <br/><br/>

    <input type="submit" value="Adicionar" />
</form>
