<!DOCTYPE html >

<html lang = "pt-pt">
	<head>
		<meta charset = "utf-8">
		<title> Estufa Automatizada </title>
		<link rel="stylesheet" type="text/css" href="folha_estilo.css">
	</head>
	
	<body>
		
		<div id="menu" href="#menu">
		
			<img  style = "margin-left: 450px ; margin-top: 100px;" src = "imagens/logo.png" >
			
				
			<nav class = "menu_login">
				<ul >
					<li><a href="#login">Login</a></li>
					<li><a href="#visitante">Visitante</a></li>
				</ul>
			</nav>
		
		</div>
		
		<section class = "section">
			
			
			<div id="login" href="#login">
				
				<div class = "corpo" style ="height: 150px">
				
					<table class = "head">
						<tr>
								<td>Login</td>
						</tr>
					</table>
					
					<form method="POST" action="processar_login.php">
						<table style ="margin-top: 30px;">
							<tr>
								<td>Nome de utilizador:</td><td><input type="text" name="username" REQUIRED autofocus></td>
							</tr>
							<tr>
								<td>Palavra-passe:</td><td> <input type="password" name="password" REQUIRED></td>
							</tr>
							<tr>
								<td class ="butões"><input type="submit" name="enviar" value="Login">
								<input type="reset" name="apagar" value="Limpar"></td>
							</tr>
						</table>
					</form>
					
					<a href="#menu"><img src ="imagens/top.png" class ="backtop" style ="left: 500px; top: -270px;"></a>
				</div>
				
				
			</div>
		

			
			<div id="visitante" href="#visitante">
				
				<div class = "corpo">
				
					<table class = "head">
						<tr>
								<td>Visitante</td>
						</tr>
					</table>
					
					
					<table style ="margin-top: 30px; width: 450px; margin-left:40px;">
						<tr>
							<td style ="padding-left:30px;"><a href="#fotografias"><img src ="imagens/imagens.png"></a></td>
							<td><a href="#agradecimentos"><img src ="imagens/agradecimentos.png"></a></td>
							<tr>
								<td style ="padding-left:45px;"><i>Fotografias</i></td>
								<td style ="padding-left:0px;"><i>Agradecimentos</i></td>
							</tr>
							
							
						</tr>
					</table>
					
					<a href="#menu"><img src ="imagens/top.png" class ="backtop" style ="left: 500px; top: -320px;"></a>
				</div>
				
			</div>
			
			
			<div id="fotografias" href="#fotografias">
				
				<div class = "corpo">
				
					<table class = "head">
						<tr>
								<td>Fotografias</td>
						</tr>
					</table>
					
					<a href="#visitante"><img src ="imagens/top.png" class ="backtop" style ="left: 500px; top: -120px;"></a>
					
					<table style ="margin-top: 10px; margin-left: 50px;">
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/background_original.jpg">
								<p>A placa Arduino sem o ethernet shield.</p>
							</td>
						</tr>
						
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/esquema.png">
								<p>O esquema elétrico.</p>
							</td>
						</tr>
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/kit_arduino.png">
								<p>O kit que eu comprei.</p>
							</td>
						</tr>
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/placa_rede.png">
								<p>A placa de rede (Ethernet Shield).</p>
							</td>
						</tr>
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/arduino_c_placa.png">
								<p>A placa de rede (Ethernet Shield) ligada ao Arduino.</p>
							</td>
						</tr>
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/sensor_humidade.png">
								<p>O sensor de humidade de solo.</p>
							</td>
						</tr>
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/sensor_temperatura.png">
								<p>O sensor de temperatura.</p>
							</td>
						</tr>
						<tr class ="foto">
							<td>
								<img src = "imagens/fotos/rele.png">
								<p>O rele de quatro ligações.</p>
							</td>
						</tr>
						
						
						
					</table>
					
					
					
				</div>
				
			</div>
			
			
			<div id="agradecimentos" href="#agradecimentos">
				
				<div class = "corpo">
				
					<table class = "head" style = "width: 120px;height: 120px; border-radius: 120px;">
						<tr>
								<td>Agradecimentos</td>
						</tr>
					</table>
					
					<a href="#visitante"><img src ="imagens/top.png" class ="backtop" style ="left: 500px; top: -140px;"></a>
					
					<table style ="margin-top: 10px; margin-left: 50px;color:black;width:700px;">
						<tr>
							<td>
								Gostaria de agradecer a toda a gente que me ajudou neste projeto.<br>
								<b>Professora Esmeralda Sofia</b> – SQL e PHP<br>
								<b>Professor Manuel Tavares</b> – SQL e ideias<br>
								<b>Tiago Batista</b> – Programação do <i>Arduino</i> e PHP<br>
								<b>José Coelho</b> – Eletricidade e ideias<br>
								<b>Hugo Santos</b> - Programação do <i>Arduino</i> e ideias<br>
								<b>Marco Wilson</b> – Eletricidade e ideias<br>
								<b>Sr. Luís Sousa</b> – Eletricidade<br>
								Obrigado.<br><br>
								<i>-Bruno Coelho</i>
							</td>
						</tr>
					</table>
					
					
				</div>
				
			</div>
		
		</section>
		
		
	</body>
</html>