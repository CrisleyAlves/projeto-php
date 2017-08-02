<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="materialize/css/materialize.min.css">
	<script type="text/javascript" src="materialize/js/jquery.min.js"></script>
	<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="materialize/js/meu.js"></script>

	<!-- icones !-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

	<?php
	if(!isset($_SESSION['adm_codigo'])){
		?>
		<nav class="green">
			<div class="nav-wrapper">
				<div class="container">
					<a class="brand-logo" href="index.php" style="color: #FFFFFF;">ADM</a>
					<a href="#" data-activates="menu-celular" class="button-collapse"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li><a class="waves-effect waves-light" href="?menu=cidade">Cidades</a></li>
						<li><a class="waves-effect waves-light" href="?menu=proprietario">Proprietario</a></li>
						<li><a class="waves-effect waves-light" href="?menu=bairro">Bairro</a></li>
						<li><a class="waves-effect waves-light" href="?menu=tipo">Tipo</a></li>
						<li><a class="waves-effect waves-light" href="?menu=operacao">Operação</a></li>
						<li><a class="waves-effect waves-light" href="?menu=imovel">Imoveis</a></li>
						<li><a class="waves-effect waves-light" href="?menu=solicitacao">Solicitações</a></li>
						<li><a class='dropdown-button' href='#' data-activates='dropdown1'>Relatórios</a></li>
						<li><a class="waves-effect waves-light" href="?menu=foto">Fotos</a></li>
						<li><a class="waves-effect waves-light" href="logof.php">Sair</a></li>

						<ul id='dropdown1' class='dropdown-content'>
							<li><a href="modulos/cidade/relatorio.php">Cidade</a></li>
							<li><a href="modulos/proprietario/relatorio.php">Proprietário</a></li>
							<li><a href="modulos/bairro/relatorio.php">Bairro</a></li>
							<li><a href="modulos/tipo/relatorio.php">Tipo</a></li>
							<li><a href="modulos/operacao/relatorio.php">Operação</a></li>
							<li><a href="modulos/imovel/relatorio.php">Imóveis</a></li>
							<li><a href="modulos/solicitacao/relatorio.php">Solicitação</a></li>
						</ul>

					</ul>

					<ul class="side-nav" id="menu-celular">
						<li><a class="waves-effect waves-light" href="?menu=cidade">Cidades</a></li>
						<li><a class="waves-effect waves-light" href="?menu=proprietario">Proprietario</a></li>
						<li><a class="waves-effect waves-light" href="?menu=bairro">Bairro</a></li>
						<li><a class="waves-effect waves-light" href="?menu=tipo">Tipo</a></li>
						<li><a class="waves-effect waves-light" href="?menu=operacao">Operação</a></li>
						<li><a class="waves-effect waves-light" href="?menu=imovel">Imoveis</a></li>
						<li><a class="waves-effect waves-light" href="?menu=solicitacao">Solicitações</a></li>

						<li><a class='dropdown-button' href='#' data-activates='mobile-dropdown'>Relatórios</a></li>

						<ul id='mobile-dropdown' class='dropdown-content'>
							<li><a href="modulos/cidade/relatorio.php">Cidade</a></li>
							<li><a href="modulos/proprietario/relatorio.php">Proprietário</a></li>
							<li><a href="modulos/bairro/relatorio.php">Bairro</a></li>
							<li><a href="modulos/tipo/relatorio.php">Tipo</a></li>
							<li><a href="modulos/operacao/relatorio.php">Operação</a></li>
							<li><a href="modulos/imovel/relatorio.php">Imóveis</a></li>
							<li><a href="modulos/solicitacao/relatorio.php">Solicitação</a></li>
						</ul>
						
						<li><a class="waves-effect waves-light" href="?menu=foto">Fotos</a></li>
						<li><a class="waves-effect waves-light" href="logof.php">Sair</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
	}
	?>
	
	<div class="container">
		<?php
	require('config.php');
	require('biblioteca/adodb/adodb.inc.php'); // arquivo de inicialização da adodb.
	require('conecta.php'); // arquivo que inicia a conecta com o banco.
	require("funcoes.php");

	if(!isset($_SESSION['adm_codigo'])){
		//$_REQUEST = recebe as informações que são sendo enviadas independente de serem enviadas por GET ou POST
		if(isset($_REQUEST['menu'])){
			$menu = $_REQUEST['menu'];
			require('modulos/'.$menu.'/'.$menu.'.php');
		}	
	}else{
		require("login_form.php");
	}
	
	?>
</div>


</body>
</html>