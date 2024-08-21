<?php
require '../CRUD_DB.php';

//se tiver algum usuário cadastrado na minha tabela crud exibirei ele aqui no meu formulário:

    $lista = []; //um array vazio
    $sql = $conectar -> query("SELECT * FROM crud"); //query de consulta ao DB para trazer toda a tabela chamada crud, nesse caso não precisa de uma função prepare()posso chamar direto a query, mesmo sendo menos seguro.

    if($sql->rowCount() > 0){//vai em $sql(banco) e conta se tem apartir de 1 usuário{
        $lista = $sql->fetchALL(PDO::FETCH_ASSOC);//vai gerar um array e jogar dentro de $lista, o status PDO::FETCH_ASSOC - vai fazer as associações de campos.
    }
?>

<a href="adicionar.php">ADICIONAR USUÁRIO</a>
<table border="1" width="100%">
<tr>
        <th>ID</th>
        <th>NOME</th>
        <th>EMAIL</th>
        <th>SENHA</th>
</tr>
<?php foreach($lista as $usuario): ?>
    <tr>
        <td><?php echo $usuario['ID']; ?></td>
        <td><?php echo $usuario['NOME']; ?></td>
        <td><?php echo $usuario['EMAIL']; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $usuario['ID']; ?>">[ Editar ]</a>
            <a href="excluir.php?id=<?php echo $usuario['ID']; ?>">[ Excluir ]</a> <?php //?id=<?php echo $usuario['ID'];associa ao id, quando o usuario apertar editar ou excluir vai associar ao ID do usuario?>
        </td>
    </tr>
<?php endforeach; ?>    
</table>