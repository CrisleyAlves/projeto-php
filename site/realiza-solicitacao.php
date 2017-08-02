<?php
	include("funcoes.php");

	$sol_nome = $_POST['sol_nome'];
	$sol_assunto = $_POST['sol_assunto'];
	$cod_imovel = $_POST['cod_imovel'];
	$sol_contato = $_POST['sol_contato'];
	$sol_email = $_POST['sol_email'];
	$sol_mensagem = $_POST['sol_mensagem'];

	solicita($sol_nome, $sol_assunto, $cod_imovel, $sol_contato, $sol_email, $sol_mensagem);

?>