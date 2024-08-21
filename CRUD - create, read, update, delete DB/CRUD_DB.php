<?php
//aqui apenas conexão com o Banco de dados

$db_name = "usandopdoecrud";
$db_host = "localhost";
$db_user = "root";
$db_password = "";

//conectando atravez da biblioteca PDO, que é instanciada, e puxa informações das variaveis com os dados de conexão e qual banco procurar la,  tipo de DB=mysql,nome do banco=projeto x, tipo de conexão=localhost, login para entrar no banco=root,senha=nao possui senha:

$conectar = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_password);

