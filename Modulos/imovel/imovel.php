<?php

	require("imovel_class.php");

	$mod = new imovel();

	if(isset($_REQUEST['acao'])){
		$acao = $_REQUEST['acao'];
	}else{
		$acao = 'listar';
	}

	switch ($acao) {
		case 'listar':
			$mod->listar();
			require("imovel_list.php");
			break;
		case 'incluir':
			require("imovel_form.php");
		break;	

		case 'gravar_incluir':
		
		if($mod->incluir($_POST['imo_endereco'],$_POST['imo_descricao'], $_POST['imo_quartos'], $_POST['imo_valor'], $_POST['imo_condominio'], $_POST['pro_codigo'], $_POST['tip_imovel'], $_POST['ope_codigo'], $_POST['bai_codigo'])){
					mensagem(config_msg_incluir);
				}else{
					mensagem(config_msg_erro);
				}
			
			$mod->listar();
			require('imovel_list.php');
		break;

		case 'excluir':
		if($mod->excluir($_GET['id'])){
			mensagem(config_msg_excluir);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("imovel_list.php");
		break;

		case 'alterar':
			$mod->editar($_GET['id']);
			require("imovel_form.php");
			break;
		case "gravar_alterar":

		$imo_codigo = $_POST['id'];
		$imo_endereco = $_POST['imo_endereco'];
		$imo_descricao = $_POST['imo_descricao'];
		$imo_quartos = $_POST['imo_quartos'];
		$imo_valor = $_POST['imo_valor'];
		$imo_condominio = $_POST['imo_condominio'];
		$pro_codigo = $_POST['pro_codigo'];
		$tip_imovel = $_POST['tip_imovel'];
		$ope_codigo = $_POST['ope_codigo'];
		$bai_codigo = $_POST['bai_codigo'];

		if($mod->alterar($imo_codigo, $imo_endereco, $imo_descricao, $imo_quartos, $imo_valor, $imo_condominio, $pro_codigo, $tip_imovel,$ope_codigo, $bai_codigo)){
			mensagem(config_msg_alterar);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();

		require("imovel_list.php");
		break;
	}
?>