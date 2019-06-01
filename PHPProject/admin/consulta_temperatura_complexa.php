<!DOCTYPE html >

<html lang = "pt-pt">
	<head>
		<meta charset = "utf-8">
		<title> Estufa Automatizada </title>
		<link rel="stylesheet" type="text/css" href="folha_estilo.css">			
		
	</head>
	<style>
		#consultas
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
		
		<?php include ('menu_consultas.php'); ?>
		
		<?php 
			$tipo_consulta = $_POST['tipo_consulta'];
		?>
		
		<table class ="conteudo">
			
			
			<form action = "processar_consulta_temperatura_complexa.php" method = "POST">
			
				<tr>
					<td>Tipo de consulta<br>
					<input list="tipos" name = "tipo_consulta" value = "<?php echo $tipo_consulta?>">
						<datalist id="tipos">
							<option value="Por data">
							<option value="Por temperatura">
						</datalist>
					</td>	
				</tr>
				
				<?php
					if ($tipo_consulta == "Por data")
					{
						echo ("<tr>
							<td><br>Dia<br>
							<input type = 'text' name ='dia' value ='1'></td>
							</tr>
							<tr>
								<td><br>Mês<br>
								<input type = 'text' name ='mes' value ='1'></td>
							</tr>
							<tr>
								<td><br>Ano<br>
								<input type = 'text' name ='ano' value ='2014'></td>
							</tr>");
					}
					else if ($tipo_consulta == "Por temperatura")
					{
						echo("<tr>
							<td><br>Temperatura<br>
							<input type = 'text' name ='temperatura'</td>
						</tr>");
					}
				?>
				
				<tr>
					<td style = "padding: 10px;">
						<input type = "submit" value = "Procurar">
					</td>
				</tr>
			
			</form>
		</table>
		
		
		
	
	</section>
		
	<?php include ('footer.php'); ?>
		
	</body>
</html>