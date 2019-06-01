
<?php
	//Ligar à base de dados
	$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

	//Selecionar a base de dados pretendida
	mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

	
	//PARA PALAVRAS ACENTOADAS
	mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());

	//Temperatura
	$temperatura = $_GET["temp"];
	$sql_inserir = "INSERT INTO temperatura (temp, hora) VALUES ('$temperatura', NOW())";
	mysql_query($sql_inserir);

	//Humidade
	$humidade = $_GET["hum"];
	$sql_inserir = "INSERT INTO humidade (hum, hora) VALUES ('$humidade', NOW())";
	mysql_query($sql_inserir);

	
?>
