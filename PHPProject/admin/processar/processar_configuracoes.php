<?php

	//Ligar à base de dados
	$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

	//Selecionar a base de dados pretendida
	mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

	
	//PARA PALAVRAS ACENTOADAS
	mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());

	
	
	
	
		$rega_automatica = $_GET['rega_automatica'];
		$tempo_rega_automatica = $_GET['tempo_rega_automatica'];
		$tempo_rega_manual = $_GET['tempo_rega_manual'];
		$rega_1= $_GET['rega_1'];
		$rega_2= $_GET['rega_2'];
		
		
		
		echo $rega_1;
		
		//DESLIGAR REGA AUTOMÁTICA
		$desligar_r_auto_sql = "INSERT INTO config (rega_automatica,tempo_rega_automatica,tempo_rega_manual,rega_1,rega_2)
		VALUES ('$rega_automatica','$tempo_rega_automatica','$tempo_rega_manual','$rega_1','$rega_2')";
		//LIGAR REGA AUTOMÁTICA
		$ligar_r_auto_sql = "INSERT INTO config (rega_automatica,tempo_rega_automatica,tempo_rega_manual,rega_1,rega_2)
		VALUES ('$rega_automatica','$tempo_rega_automatica','$tempo_rega_manual','$rega_1','$rega_2')";
		
		
		//Se o tempo de rega AUTOMÁTICA tiver valores negativos ou 0 irá por defeito regar somente 1 minuto
		if ($tempo_rega_automatica<=0)
			$tempo_rega_sql = "INSERT INTO config (rega_automatica,tempo_rega_automatica,tempo_rega_manual,rega_1,rega_2)
			VALUES ('$rega_automatica',1,'$tempo_rega_manual','$rega_1','$rega_2'";
		else
			$tempo_rega_sql = "INSERT INTO config (rega_automatica,tempo_rega_automatica,tempo_rega_manual,rega_1,rega_2)
			VALUES ('$rega_automatica','$tempo_rega_automatica','$tempo_rega_manual','$rega_1','$rega_2'";
		
		//Se o tempo de rega MANUAL tiver valores negativos ou 0 irá por defeito regar somente 1 minuto
		if ($tempo_rega_manual<=0)
			$tempo_rega_sql_manual = "INSERT INTO config (rega_automatica,tempo_rega_automatica,tempo_rega_manual,rega_1,rega_2)
			VALUES ('$rega_automatica','$tempo_rega_automatica',1,'$rega_1','$rega_2'";
		else
			$tempo_rega_sql_manual = "INSERT INTO config (rega_automatica,tempo_rega_automatica,tempo_rega_manual,rega_1,rega_2)
			VALUES ('$rega_automatica','$tempo_rega_automatica','$tempo_rega_manual','$rega_1','$rega_2'";
		
		
		
		
		if ($rega_automatica == 'N')
		{
			mysql_query($desligar_r_auto_sql);
			mysql_query($tempo_rega_sql);
			mysql_query($tempo_rega_sql_manual);
		}
		else
		{
			mysql_query($ligar_r_auto_sql);
			mysql_query($tempo_rega_sql);
			mysql_query($tempo_rega_sql_manual);
		}
	
		
		
	//MUDAR SEMPRE QUE HOUVER MUDANÇA DE VERSÃO
	header('Location:  ..\configuracoes.php');

?>