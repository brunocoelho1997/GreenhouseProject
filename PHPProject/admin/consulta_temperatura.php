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
		
		<table class ="conteudo">
			<form action = "consulta_temperatura_complexa.php" method = "POST">
			
				<tr>
					<td>Tipo de consulta<br>
					<input list="tipos" name = "tipo_consulta">
						<datalist id="tipos">
							<option value="Por data">
							<option value="Por temperatura">
						</datalist>
					</td>	
				</tr>
				
				
				<tr>
					<td style = "padding: 10px;">
						<input type = "submit" value = "Procurar">
					</td>
				</tr>
			
			</form>
		</table>
		
		
		
		
		
		
		
		
		<?php
		//Ligar à base de dados
		$ligacao = mysql_connect('localhost', 'root', '') or die ("Nao é possivel ligar a base de dados");

		//Selecionar a base de dados pretendida
		mysql_select_db ('estufa_automatizada', $ligacao) or die (mysql_error($ligacao));

		
		//PARA PALAVRAS ACENTOADAS
		mysql_query("SET NAMES 'utf8'") OR DIE (mysql_error());



		//fixar o nº de registos por página
		$registos_por_pag = 10;

		//Caso seja a 1ª página, é atribuído o valor de pagina =1
		if(empty($_GET['pagina'])){
			$_GET['pagina'] =1;
			$pagina = 1;
		}

		//calcular o valor do 1º registo a solicitar
		$primeiro_registo = ($_GET['pagina'] * $registos_por_pag) -$registos_por_pag;

		//Criar a consulta à base de dados COM LIMIT
		$sql = "SELECT * FROM temperatura ORDER BY hora DESC
		LIMIT $primeiro_registo, $registos_por_pag";

		//Criar a variável $consulta que guarda os resultados obtidos
		$consulta = mysql_query($sql);

		//Verificar se existem resultados e mostrá-los
		if($consulta){
		?>
		
		<!-- construção da tabela -->
		
		
		
		<table class="tabela_consulta">
		<tr>
		<form name="form_alterar" method="POST" >
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
		</form>
		
		<?php
			echo ("<table id = 'tabela_pag'>");
		
		
			//------------------- navegação entre páginas-------------------
			
			//Calcular o total de nº de registos e nº de páginas necessárias
			$sql_todos_registos = mysql_query("SELECT * FROM temperatura ORDER BY hora DESC");
			$total_registos = mysql_num_rows($sql_todos_registos);
			$total_paginas=ceil($total_registos/$registos_por_pag);
			$total_paginas++;
			
			//determinar o valor da página atual
			$pagina=$_GET['pagina'];
			
			
			if($pagina ==1)
			{
				echo "<td colspan=4 align='center'>";
				echo "<a href=?pagina=".($pagina-1)."></a></td>";
			}
			else{
				
				echo "<td colspan=4 align='center'>";
				echo "<a href=?pagina=".($pagina-1)."><b>Anterior</b></a></td>";
			}
			
			
			
			//determinar se é a última página
			if(($pagina+1) < $total_paginas)
			{
				echo "<td colspan=4 align='center'>";
				echo "<a href=?pagina=".($pagina+1)."><b>| Seguinte</b></a></td>";
			}
			else
			{
				echo "<td></td>";
				echo "";
			}
			
			echo ("</table>");
				
			}//Caso não haja registos, informa o utilizador
			else
			{
				echo ("<tr><td>A base de dados não contém registos.</td></tr>");
			}
		?>
		
	</section>
	
	<?php include ('footer.php'); ?>
	
	</body>
</html>