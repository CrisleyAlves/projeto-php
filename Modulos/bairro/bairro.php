<?php

	require("bairro_class.php");

	$mod = new bairro();

	if(isset($_REQUEST['acao'])){
		$acao = $_REQUEST['acao'];
	}else{
		$acao = 'listar';
	}

	switch ($acao) {
		case 'listar':
			$mod->listar();
			require("bairro_list.php");
			break;
		case 'incluir':
			require("bairro_form.php");
		break;	

		case 'gravar_incluir':
		if($mod->repetido($_POST['bai_nome'], $_POST['cid_codigo']) > 0){
			mensagem(config_msg_existe);
		}else{
			if($mod->incluir($_POST['bai_nome'], $_POST['cid_codigo'])){
				mensagem(config_msg_incluir);
			}else{
				mensagem(config_msg_erro);
			}
		}
			
			$mod->listar();
			require('bairro_list.php');
		break;

		case 'excluir':
		if($mod->excluir($_GET['id'])){
			mensagem(config_msg_excluir);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("bairro_list.php");
		break;

		case 'alterar':
			$mod->editar($_GET['id']);
			require("bairro_form.php");
			break;
		case "gravar_alterar":
		$bai_codigo = $_POST['id'];
		$bai_nome = $_POST['bai_nome'];
		$cid_codigo = $_POST['cid_codigo'];
		
		if($mod->alterar($bai_codigo, $bai_nome,$cid_codigo)){
			mensagem(config_msg_alterar);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("bairro_list.php");
		break;
	}
?>