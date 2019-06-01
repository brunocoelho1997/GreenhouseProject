<!DOCTYPE html >

<html lang = "pt-pt">
	<head>
		<meta charset = "utf-8">
		<title> Estufa Automatizada </title>
		<link rel="stylesheet" type="text/css" href="folha_estilo.css">	
		
	</head>
	<style>
		#configuracoes
		{
			height: 100px;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 5px;
			color: #F0F0F0;
		}
	</style>

	<?php include ('../verificar_sessao.php'); ?>
		
	<body>
	
		
		<?php
		
			//Ligar à base de dados
			$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

			//Selecionar a base de dados pretendida
			mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

			
			//PARA PALAVRAS ACENTOADAS
			mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());
			
			//Estado atual da água
			$sql="SELECT * FROM config ORDER BY idconfig DESC LIMIT 1;";
			$consulta=mysql_query($sql);
			
			while ($mostrar = mysql_fetch_array($consulta))
			{
				$rega_automatica = $mostrar["rega_automatica"];
				$tempo_rega_automatica = $mostrar["tempo_rega_automatica"];
				$tempo_rega_manual = $mostrar["tempo_rega_manual"];
				$rega_1 = $mostrar["rega_1"];
				$rega_2 = $mostrar["rega_2"];
				
			}
	
		?>
		
		
		
		<section class = "section">
			
			<?php include ('menu_admin.php'); ?>
			
			<table class ="conteudo">
					<tr>
						<td>
							<p>Tempo de rega manual(minutos):
								<?php						
									echo "<form action='processar/processar_configuracoes.php'>
									<input type='text' name='tempo_rega_manual' value='$tempo_rega_manual'>
									
									<input type='hidden' name='tempo_rega_automatica' value='$tempo_rega_automatica'>
									<input type='hidden' name='rega_automatica' value='$rega_automatica'>
									<input type='hidden' name='rega_1' value = '$rega_1' />
									<input type='hidden' name='rega_2' value = '$rega_2' />
									
									<input type='submit' value='Alterar' class ='botões'>
									</form>";
								?>
							</p>
						</td>
					</tr>					
			</table>
			
			<fieldset>
			<legend>Rega Automática</legend>
			
			
				<table>
					<tr>
						<td>
							<p>Rega Automática:
								<?php
									
									if ($rega_automatica == 'S')
									{
										
										echo "<form action='processar/processar_configuracoes.php'>
										<input type='hidden' name='rega_automatica' value='N'>
										<input type='hidden' name='tempo_rega_automatica' value='$tempo_rega_automatica'>
										<input type='hidden' name='tempo_rega_manual' value='$tempo_rega_manual'>
										<input type='hidden' name='rega_1' value = '$rega_1' />
										<input type='hidden' name='rega_2' value = '$rega_2' />
										
										<input type='submit' value='Ligar' disabled id='ligar'>
										<input type='submit' value='Desligar' id='desligar'></form>";
										
									}
									else
									{
										
										echo "<form action='processar/processar_configuracoes.php'>
										<input type='hidden' name='rega_automatica' value='S'>
										<input type='hidden' name='tempo_rega_automatica' value='$tempo_rega_automatica'>
										<input type='hidden' name='tempo_rega_manual' value='$tempo_rega_manual'>
										<input type='hidden' name='rega_1' value = '$rega_1' />
										<input type='hidden' name='rega_2' value = '$rega_2' />
										
										<input type='submit' value='Ligar' id='ligar'>
										<input type='submit' value='Desligar' disabled id='desligar'></form>";
										
									}
									
								?>
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<p>Tempo de rega (minutos):
								<?php
									
									if($rega_automatica == 'N')
										echo "<form action='processar/processar_configuracoes.php'>
										<input type='text' name='tempo_rega_automatica' value='$tempo_rega_automatica' disabled>
										<input type='submit' value='Alterar' disabled class ='botões'>
										</form>";
									else								
										echo "<form action='processar/processar_configuracoes.php'>
										<input type='text' name='tempo_rega_automatica' value='$tempo_rega_automatica'>
										
										<input type='hidden' name='rega_automatica' value='$rega_automatica'>
										<input type='hidden' name='tempo_rega_manual' value='$tempo_rega_manual'>
										<input type='hidden' name='rega_1' value = '$rega_1' />
										<input type='hidden' name='rega_2' value = '$rega_2' />
										
										<input type='submit' value='Alterar' class ='botões'>
										</form>";
								?>
							</p>
						</td>
					</tr>
				</table>
					<tr>
						<td>
							<p>Rega 1:
								<?php

									echo "<form action='processar/processar_configuracoes.php'>
									<input type='time' name='rega_1' value = '$rega_1' />
									
									<input type='hidden' name='tempo_rega_manual' value='$tempo_rega_manual'>
									<input type='hidden' name='tempo_rega_automatica' value='$tempo_rega_automatica'>
									<input type='hidden' name='rega_automatica' value='$rega_automatica'>
									<input type='hidden' name='rega_2' value = '$rega_2' />

									<input type='submit' value='Alterar' class ='botões'>
									</form>";
								?>
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<p>Rega 2:
								<?php

									echo "<form action='processar/processar_configuracoes.php'>
									<input type='time' name='rega_2' value = '$rega_2' />
									
									<input type='hidden' name='tempo_rega_manual' value='$tempo_rega_manual'>
									<input type='hidden' name='tempo_rega_automatica' value='$tempo_rega_automatica'>
									<input type='hidden' name='rega_automatica' value='$rega_automatica'>
									<input type='hidden' name='rega_1' value = '$rega_1' />

									<input type='submit' value='Alterar' class ='botões'>
									</form>";
								?>
							</p>
						</td>
					</tr>
			
			
			</fieldset>
			
		</section>
		
		<?php include ('footer.php'); ?>
		
		
		
	</body>
</html>