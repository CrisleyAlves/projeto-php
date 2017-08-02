<?php

	require("proprietario_class.php");

	$mod = new cidade();

	if(isset($_REQUEST['acao'])){
		$acao = $_REQUEST['acao'];
	}else{
		$acao = 'listar';
	}

	switch ($acao) {
		case 'listar':
			$mod->listar();
			require("proprietario_list.php");
			break;
		case 'incluir':
			require("proprietario_form.php");
		break;	

		case 'gravar_incluir':
			if($mod->repetidoCpf($_POST['pro_cpf']) > 0){
				mensagem(config_msg_existe);
			}else if($mod->repetidoRg($_POST['pro_rg']) > 0){
				mensagem(config_msg_existe);
			}else{
				if($mod->incluir($_POST['pro_nome'],$_POST['pro_cpf'], $_POST['pro_rg'], $_POST['pro_email'], $_POST['pro_contato'])){
					mensagem(config_msg_incluir);
				}else{
						mensagem(config_msg_erro);
					}
			}
			$mod->listar();
			require('proprietario_list.php');
		break;

		case 'excluir':
		if($mod->excluir($_GET['id'])){
			mensagem(config_msg_excluir);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("proprietario_list.php");
		break;

		case 'alterar':
			$mod->editar($_GET['id']);
			require("proprietario_form.php");
			break;
		case "gravar_alterar":
		
		$pro_id = $_POST['id'];
		$pro_nome = $_POST['pro_nome'];
		$pro_cpf = $_POST['pro_cpf'];
		$pro_rg = $_POST['pro_rg'];
		$pro_email = $_POST['pro_email'];
		$pro_contato = $_POST['pro_contato'];

		if($mod->alterar($pro_id, $pro_nome, $pro_cpf, $pro_rg, $pro_email, $pro_contato)){
			mensagem(config_msg_alterar);
		}else{
			mensagem(config_msg_erro);
		}
		$mod->listar();

		require("proprietario_list.php");
		break;
	}
?>