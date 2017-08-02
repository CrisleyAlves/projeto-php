<?php

	require("cidade_class.php");

	$mod = new cidade();

	if(isset($_REQUEST['acao'])){
		$acao = $_REQUEST['acao'];
	}else{
		$acao = 'listar';
	}

	switch ($acao) {
		case 'listar':
			$mod->listar();
			require("cidade_list.php");
			break;
		case 'incluir':
			require("cidade_form.php");
		break;	

		case 'gravar_incluir':
			if($mod->verifica($_POST['cid_nome'], $_POST['cid_uf']) > 0){
				mensagem(config_msg_existe);
			}else{
				if($mod->incluir($_POST['cid_nome'],$_POST['cid_uf'])){
					mensagem(config_msg_incluir);
				}else{
					mensagem(config_msg_erro);
				}
			}
			$mod->listar();
			require('cidade_list.php');
		break;

		case 'excluir':
		if($mod->excluir($_GET['id'])){
			mensagem(config_msg_excluir);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("cidade_list.php");
		break;

		case 'alterar':
			$mod->editar($_GET['id']);
			require("cidade_form.php");
			break;
		case "gravar_alterar":

		if($mod->verifica2($_POST['cid_nome'], $_POST['id']) > 0){
			mensagem(config_msg_existe);
		}else{

		if($mod->alterar($_POST['cid_nome'],$_POST['cid_uf'], $_POST['id'])){
			mensagem(config_msg_alterar);
		}else{
			mensagem(config_msg_erro);
		}
		}

		$mod->listar();

		require("cidade_list.php");
		break;
	}
?>