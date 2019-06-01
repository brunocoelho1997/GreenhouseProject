<!DOCTYPE html >

<html lang = "pt-pt">
	<head>
		<meta charset = "utf-8">
		<title> Estufa Automatizada </title>
		<link rel="stylesheet" type="text/css" href="folha_estilo.css">	
	</head>
		
	<style>
		#valvula
		{
			height: 100px;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 5px;
			color: #F0F0F0;
		}
	</style>

	
	<?php include ('../verificar_sessao.php'); ?>
	
	<body>
	
		<section class = "section">
			
			<?php include ('menu_admin.php'); ?>
			
			<table class ="conteudo">
				
				<?php
					//Ligar à base de dados
					$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

					//Selecionar a base de dados pretendida
					mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

					
					//PARA PALAVRAS ACENTOADAS
					mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());
					
					
					//Estado atual da água
					$sql="SELECT * FROM rega ORDER BY idrega DESC LIMIT 1;";
					$estado_atual=mysql_query($sql);

				?>
				
				<tr>
					<td>
						<p>Estado atual da água:
							<?php
								while ($mostrar = mysql_fetch_array($estado_atual))
								{
									$estado = $mostrar["estado"];
									
									if ($estado == 'S')
									{
										echo "Ligada <br>";
										echo "<form action='processar/ligar_desligar_agua.php'>
												<input type='hidden' name='agua' value=0>
												<input type='submit' value='Ligar' disabled id='ligar'>
												<input type='submit' value='Desligar' id='desligar'>
											</form>";
									}
									else
									{
										echo "Desligada <br>";
										echo "<form action='processar/ligar_desligar_agua.php'>
												<input type='hidden' name='agua' value=1>
												<input type='submit' value='Ligar' id='ligar'>
												<input type='submit' value='Desligar' disabled id='desligar'>
											</form>";
									}	
								}
							?>
						</p>
					</td>
				</tr>
			</table>
			
		</section>
		
		
		<?php include ('footer.php'); ?>
		
		
	</body>
</html>