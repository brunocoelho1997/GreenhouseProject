<?php

	//Ligar à base de dados
	$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

	//Selecionar a base de dados pretendida
	mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

	
	//PARA PALAVRAS ACENTOADAS
	mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());

	//É necessário definir a timezone para as horas estarem correctas
	date_default_timezone_set('Europe/Lisbon');
	date_default_timezone_get();

	$estado_agua = $_GET['agua'];
	
	
	
	//CONSULTA PARA OBTER O TEMPO DE REGA MANUAL
	$sql_rega_manual = "SELECT * FROM config ORDER BY idconfig DESC LIMIT 1";
	$consulta = mysql_query($sql_rega_manual);

	while($dados=mysql_fetch_array($consulta)){
		$tempo_rega_manual = $dados['tempo_rega_manual'];
	}
	
	//HORA ATUAL
	$hinicial = date('Y-m-d H:i:s');
	//HORA final COM OS MINUTOS ADICIONADOS
	$hfinal = date('Y-m-d H:i:s', strtotime($hinicial.'+'.$tempo_rega_manual.'minute'));
	
	
	
	
	
	
	
	
	//DESLIGAR ÁGUA
	$desligar_sql = "INSERT INTO rega (hinicial,hfinal,tiporega,estado)
	VALUES (NOW(),'$hfinal','M','N');";
	//LIGAR ÁGUA
	$ligar_sql = "INSERT INTO rega (hinicial,hfinal,tiporega,estado)
	VALUES (NOW(),'$hfinal','M','S');";
	
	if ($estado_agua == 0)
		mysql_query($desligar_sql);
	else
	{
		mysql_query($ligar_sql);
	}	
	
	header('Location:  ..\valvula.php');

?>