<!DOCTYPE html >

<html lang = "pt-pt">
	<head>
		<meta charset = "utf-8">
		<title> Estufa Automatizada </title>
		<link rel="stylesheet" type="text/css" href="folha_estilo.css">	
		<style>
			#home
			{
				height: 100px;
				border-bottom-right-radius: 5px;
				color: #F0F0F0;
			}
		</style>

	</head>
	
	<body>
	
		<?php include ('../verificar_sessao.php'); ?>
		
		<?php
		
			//Ligar à base de dados
			$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

			//Selecionar a base de dados pretendida
			mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

			
			//PARA PALAVRAS ACENTOADAS
			mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());
			
			$sql_temp = "SELECT temp FROM temperatura ORDER BY idT DESC  LIMIT 1";
			$consulta_temp = mysql_query($sql_temp);
			while($dados_temp=mysql_fetch_array($consulta_temp)){
				$temp = $dados_temp['temp'];
				
			}
			
			$sql_hum = "SELECT hum FROM humidade ORDER BY idH DESC  LIMIT 1";
			$consulta_hum = mysql_query($sql_hum);
			while($dados_hum=mysql_fetch_array($consulta_hum)){
				$hum = $dados_hum['hum'];
				
			}
			
			$sql_rega = "SELECT * FROM rega ORDER BY idrega DESC  LIMIT 1";
			$consulta_rega = mysql_query($sql_rega);
			while($dados_rega=mysql_fetch_array($consulta_rega)){
				$estado = $dados_rega['estado'];
				
			}

			$sql_auto = "SELECT * FROM config ORDER BY idconfig DESC  LIMIT 1";
			$consulta_auto = mysql_query($sql_auto);
			while($dados_auto=mysql_fetch_array($consulta_auto)){
				$rega_automatica= $dados_auto['rega_automatica'];
				$rega_1= $dados_auto['rega_1'];
				$rega_2= $dados_auto['rega_2'];
			}

			
			
			
		?>
		
		
		
		
		
		<section class = "section">
			
			<?php include ('menu_admin.php'); ?>
			
			<table class ="conteudo" style ="padding-left:15%; width:800px;">
				<tr>
					<td style ="padding-left:-40px;"><h3><img src ="imagens/sensor_temperatura.png"><br>Temperatura <?php echo $temp ?>ºC</h3></td>
	
					<td style ="padding-left:60px;"><h3><img src ="imagens/sensor_humidade.png"><br>Humidade <?php echo $hum ?>%</h3></td>
				</tr>
				<tr>
					<td>
						<?php 
							
							if ($estado =="N")
								echo "<h3>Rega: desligada<br><br>
										<img src ='imagens/rega_desligada.png'></h3>";
							else
								echo "<h3>Rega: ligada<br><br>
										<img src ='imagens/rega_ligada.png'></h3>";
						?>
					</td>
					<td>
						<?php 
							
							if ($rega_automatica =="N")
								echo "<h3>Rega automática: desligada<br><br>
										<img style ='margin-left:60px;' src ='imagens/desligada.png'></h3>";
							else
								echo "<h3>Rega automática: ligada<br><br>
										<img style ='margin-left:60px;' src ='imagens/ligada.png'></h3>";
						?>
					</td>
					
				</tr>
			</table>
		</section>
		
		<?php include ('footer.php'); ?>
		
		
		
		
	</body>
</html>