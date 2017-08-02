<?php

	require("operacao_class.php");

	$mod = new operacao();

	if(isset($_REQUEST['acao'])){
		$acao = $_REQUEST['acao'];
	}else{
		$acao = 'listar';
	}

	switch ($acao) {
		case 'listar':
			$mod->listar();
			require("operacao_list.php");
			break;
		case 'incluir':
			require("operacao_form.php");
		break;	

		case 'gravar_incluir':
			if($mod->repetido($_POST['ope_nome']) > 0 ){
				mensagem(config_msg_existe);
			}else{
				if($mod->incluir($_POST['ope_nome'])){
					mensagem(config_msg_incluir);
				}else{
					mensagem(config_msg_erro);
				}
			}
			$mod->listar();
			require('operacao_list.php');
		break;

		case 'excluir':
		if($mod->excluir($_GET['id'])){
			mensagem(config_msg_excluir);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("operacao_list.php");
		break;

		case 'alterar':
			$mod->editar($_GET['id']);
			require("operacao_form.php");
			break;
		case "gravar_alterar":

		$tip_codigo = $_POST['id'];
		$tip_nome = $_POST['ope_nome'];

		if($mod->alterar($tip_codigo, $tip_nome)){
			mensagem(config_msg_alterar);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();

		require("operacao_list.php");
		break;
	}
?>