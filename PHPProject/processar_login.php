<!DOCTYPE html >

<html lang = "pt-pt">
	<head>
		<meta charset = "utf-8">	
	</head>
	
	<body>
		<?php
		
		//Ligar à base de dados
		$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

		//Selecionar a base de dados pretendida
		mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

		
		//PARA PALAVRAS ACENTOADAS
		mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());

		
		
		//Definir $username e $password
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		
		
		//Consulta a base de dados
		$sql = "SELECT * FROM utilizadores WHERE username = '$username' AND pass='$password'";
		
		$consulta = mysql_query($sql);
		
		if (mysql_num_rows($consulta) > 0) {
			
			session_start();
			// Caso os dados de login estejam certos, envia para página index.php

			$_SESSION["username"] = $username;
			header("Location: admin\index.php");
	
		}
		else
		{
			include ('index.php');
			echo ('<script>window.alert("Utilizador inexistente ou palavra passe errada!");</script>');
		}
		

	?>
	
</body>
</html>