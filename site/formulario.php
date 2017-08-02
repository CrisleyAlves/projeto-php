<?php
	include("topoSite.php");
?>

<div class="formulario">
		<div class="container-16">
		<h1>Solicitação de contato</h1>
			<form action="realiza-solicitacao.php" method="POST">
				<input type="text" name="sol_nome" id="sol_nome" placeholder="INFORME O NOME">
				<input type="text" name="sol_assunto" id="sol_assunto" placeholder="INFORME O ASSUNTO">
				<input type="text" name="cod_imovel" id="cod_imovel" placeholder="INFORME O CÓDIGO DO IMÓVEL (CASO O TENHA) ">
				<input type="text" name="sol_contato" id="sol_contato" placeholder="INFORME SEU TELEFONE PARA CONTATO">
				<input type="text" name="sol_email" id="sol_email" placeholder="INFORME SEU EMAIL">
				<input type="text" name="sol_mensagem" id="sol_mensagem" placeholder="INFORME A MENSAGEM">
				<input class="enviar" type="submit" value="Enviar">
			</form>
		</div>
</div>
<br>
<?php
	include("footerSite.php");
?>