<!DOCTYPE html >

<html lang = "pt-pt">
	<head>
		<meta charset = "utf-8">
		<title> Estufa Automatizada </title>
		<link rel="stylesheet" type="text/css" href="folha_estilo.css">			
		
	</head>

	
<body>
	
	
	<section class = "section">
		
		<?php include ('menu_admin.php'); ?>
		<?php include ('menu_consultas.php'); ?>
		
		<?php 
		
			//Ligar à base de dados
			$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

			//Selecionar a base de dados pretendida
			mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

			
			//PARA PALAVRAS ACENTOADAS
			mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());
		
		
			$tipo_consulta = $_POST['tipo_consulta'];			
			
			
			
			if($tipo_consulta =="Por data")
			{
				
				$dia = $_POST['dia'];
				$mes = $_POST['mes'];
				$ano = $_POST['ano'];
				
				

				$sql = "SELECT * FROM temperatura WHERE hora BETWEEN ' $ano-$mes-$dia 00:00:00' AND '$ano-$mes-$dia 23:59:59' ORDER BY `hora`";

				//Criar a variável $consulta que guarda os resultados obtidos
				$consulta = mysql_query($sql);

				
				?>
				
				<table class="tabela_consulta">
				<tr>
				<tr>
					<th width="100">ID</th>
					<th width="200">Temperatura</th>
					<th width="300">Hora</th>
				</tr>

				<?php
					while($user=mysql_fetch_array($consulta)){ ?>
					<tr align="center" >
					<td><?php echo $user['idT']; ?></td>
					<td><?php echo $user['temp']; ?></td>
					<td><?php echo $user['hora']; ?></td>
					
				<?php
				}
				?>
				</tr>
				</tr>
				</table>
				
				
				
			
	
			<?php
			}
			else if($tipo_consulta =="Por temperatura")
			{
				$temperatura = $_POST['temperatura'];
			
				$sql = "SELECT * FROM temperatura WHERE temp = $temperatura ORDER BY `hora`";

				//Criar a variável $consulta que guarda os resultados obtidos
				$consulta = mysql_query($sql);

				
				?>
				
				<table class="tabela_consulta">
				<tr>
				<tr>
					<th width="100">ID</th>
					<th width="200">Temperatura</th>
					<th width="300">Hora</th>
				</tr>

				<?php
					while($user=mysql_fetch_array($consulta)){ ?>
					<tr align="center" >
					<td><?php echo $user['idT']; ?></td>
					<td><?php echo $user['temp']; ?></td>
					<td><?php echo $user['hora']; ?></td>
					
				<?php
				}
				?>
				</tr>
				</tr>
				</table>
			<?php
			} 
			?>

				
	</section>	
	
	<?php include ('footer.php'); ?>
	
	</body>
</html>