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
	
	
	
	//BUSCAR TUDO DO ÚLTIMO VALOR DA REGA MANUAL EXISTENTE (SE ESTÁ LIGADA/DESLIGADA E O SEU TEMPO)
	$sql_rega_manual = "SELECT * FROM rega ORDER BY idrega DESC LIMIT 1";
	$consulta_manual = mysql_query($sql_rega_manual);

	while($dados_rega_manu=mysql_fetch_array($consulta_manual)){
		$hinicial = $dados_rega_manu['hinicial'];
		$hfinal = $dados_rega_manu['hfinal'];
		$tiporega = $dados_rega_manu['tiporega'];
		$estado = $dados_rega_manu['estado'];	
	}
	
	//BUSCAR A QUE HORAS DEVE REGAR E O SEU TEMPO
	$sql_rega_automatica = "SELECT * FROM config ORDER BY idconfig DESC LIMIT 1";
	$consulta_automatica = mysql_query($sql_rega_automatica);

	while($dados_rega_auto=mysql_fetch_array($consulta_automatica)){
		$rega_automatica = $dados_rega_auto['rega_automatica'];
		$tempo_rega_automatica = $dados_rega_auto['tempo_rega_automatica'];
		$rega_1 = $dados_rega_auto['rega_1'];
		$rega_2 = $dados_rega_auto['rega_2'];
		
		
	}
	
	
	
	$hatual = date('Y-m-d H:i:s'); //ESTA HORA ATUAL TEM DIA 
	
	$horaatual = date('H:i:s'); //ESTA HORA ATUAL NÃO TEM DIA PORQUE A REGA AUTOMÁTICA É PARA TODOS OS DIAS, A AQUELA HORA
	//CONVERSÃO DAS HORAS EM SEGUNDOS
	$horaatual = strtotime($horaatual);
	$rega_1 = strtotime($rega_1);
	$rega_2 = strtotime($rega_2);
	
	//TEMPO FINAL DE REGA AUTOMÁTICA
	$horafinal1=$rega_1 + 60*$tempo_rega_automatica;
	$horafinal2=$rega_2 + 60*$tempo_rega_automatica;
	
	
	if ($tiporega == 'M' && $estado=='S')
	{
		
		if ($hatual > $hfinal)
		{
			echo 'n';
			mysql_query("INSERT INTO rega (hinicial,hfinal,tiporega,estado)
			VALUES ('$hatual',NOW(),'M','N');");
		}
		else
			echo 's';

		
	}
	else if ($rega_automatica == 'S')
	{
	
		
		if ($horaatual == $rega_1 || $horaatual == $rega_1+1 || $horaatual == $horafinal1-1) 
		{
			echo 's';
			mysql_query("INSERT INTO rega (hinicial,hfinal,tiporega,estado)
			VALUES (NOW(),NOW(),'A','S');");
			//MANDAR EMAIL
			$to = "brunocoelho1997@gmail.com";
			$subject = "Rega automática";
			$txt = "A rega foi ligada automaticamente às $hatual e será desligada automaticamente após $tempo_rega_automatica minutos.";
			$headers = "From: admin@estufautomatizada.zz.vc";
			mail($to,$subject,$txt,$headers);
		}
		else if ($horaatual == $rega_2 || $horaatual == $rega_2+1 || $horaatual == $rega_2-1 ) 
		{
			echo 's';
			mysql_query("INSERT INTO rega (hinicial,hfinal,tiporega,estado)
			VALUES (NOW(),NOW(),'A','S');");
			//MANDAR EMAIL
			$to = "brunocoelho1997@gmail.com";
			$subject = "Rega automática";
			$txt = "A rega foi ligada automaticamente às $hatual e será desligada automaticamente após $tempo_rega_automatica minutos.";
			$headers = "From: admin@estufautomatizada.zz.vc";
			mail($to,$subject,$txt,$headers);			
		}
		
		else if ($horaatual == $horafinal1 || $horaatual == $horafinal1+1 || $horaatual == $horafinal1-1)
		{
			echo 'n';
			mysql_query("INSERT INTO rega (hinicial,hfinal,tiporega,estado)
			VALUES (NOW(),NOW(),'A','N');");
			//MANDAR EMAIL
			$to = "brunocoelho1997@gmail.com";
			$subject = "Rega automática";
			$txt = "A rega foi desligada automaticamente.";
			$headers = "From: admin@estufautomatizada.zz.vc";
			mail($to,$subject,$txt,$headers);
		}
		else if ($horaatual == $horafinal2 || $horaatual == $horafinal2-1 || $horaatual == $horafinal2+1)
		{
			echo 'n';
			mysql_query("INSERT INTO rega (hinicial,hfinal,tiporega,estado)
			VALUES (NOW(),NOW(),'A','N');");
			//MANDAR EMAIL
			$to = "brunocoelho1997@gmail.com";
			$subject = "Rega automática";
			$txt = "A rega foi desligada automaticamente.";
			$headers = "From: admin@estufautomatizada.zz.vc";
			mail($to,$subject,$txt,$headers);
		}
		else if ($estado =='S' && $tiporega =="A")
		{
			echo 's';
		}
		else
		{
			echo 'n';
		}
	}
	else
	{
		echo 'n';
	}
	
	
		
?> 