<?php

	require("foto_class.php");

	$mod = new foto();

	if(isset($_REQUEST['acao'])){
		$acao = $_REQUEST['acao'];
	}else{
		$acao = 'listar';
	}

	switch ($acao) {
		case 'listar':
			$mod->listar();
			require("foto_list.php");
			break;
		case 'incluir':
			require("foto_form.php");
		break;	

		case 'gravar_incluir':
		$imo_codigo = $_POST['imo_codigo'];
		$f_imagem = $_FILES['f_imagem']['name'];
				if($mod->incluir($imo_codigo,$f_imagem)){
					mensagem(config_msg_incluir);
				}else{
					mensagem(config_msg_erro);
				}
			$mod->listar();
			require('foto_list.php');
		break;

		case 'excluir':
		$id = $_GET['id'];
		$nomeImagem = $_GET['nomeImagem'];
		if($mod->excluir($id, $nomeImagem)){
			mensagem(config_msg_excluir);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();
		require("foto_list.php");
		break;

		case 'alterar':
		$id= $_GET['id'];
		$nomeImagem=$_GET['nomeImagem'];
			$mod->editar($id, $nomeImagem);
			require("foto_form.php");
			break;
		case "gravar_alterar":

		$f_imagem = $_FILES['f_imagem']['name'];
		$fot_id = $_POST['id'];
		$imo_codigo = $_POST['imo_codigo'];

		if($mod->alterar($fot_id, $f_imagem, $imo_codigo)){
			mensagem(config_msg_alterar);
		}else{
			mensagem(config_msg_erro);
		}

		$mod->listar();

		require("foto_list.php");
		break;
	}
?>