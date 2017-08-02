<?php

	require("solicitacao_class.php");

	$mod = new solicitacao();

	if(isset($_REQUEST['acao'])){
		$acao = $_REQUEST['acao'];
	}else{
		$acao = 'listar';
	}

	switch ($acao) {
		case 'listar':
			$mod->listar();
			require("solicitacao_list.php");
			break;
		case 'incluir':
			require("solicitacao_form.php");
		break;	

		case 'gravar_incluir':
				if($mod->incluir($_POST['sol_nome'], $_POST['sol_assunto'], $_POST['cod_imovel'], $_POST['sol_contato'], $_POST['sol_email'], $_POST['sol_mensagem'])){
					mensagem(config_msg_incluir);
				}else{
					mensagem(config_msg_erro);
				}
			
			$mod->listar();
			require('solicitacao_list.php');
		break;

		case 'excluir':
		if($mod->excluir($_GET['id'])){
			mensagem(config_msg_excluir);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("solicitacao_list.php");
		break;

		case 'alterar':
			$mod->editar($_GET['id']);
			require("solicitacao_form.php");
			break;
		case "gravar_alterar":

		$sol_codigo = $_POST['id'];
		$sol_nome = $_POST['sol_nome'];
		$sol_assunto = $_POST['sol_assunto'];
		$cod_imovel = $_POST['cod_imovel'];
		$sol_contato = $_POST['sol_contato'];
		$sol_email = $_POST['sol_email'];
		$sol_mensagem = $_POST['sol_mensagem'];

		if($mod->alterar($sol_codigo, $sol_nome, $sol_assunto, $cod_imovel, $sol_contato, $sol_email, $sol_mensagem)){
			mensagem(config_msg_alterar);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();

		require("solicitacao_list.php");
		break;
	}
?>