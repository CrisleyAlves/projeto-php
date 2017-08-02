<?php
	/*	ARQUIVO DE CONFIGURAÇÃO	*/

	define('config_bd','postgres');
	define('config_bd_nome','imobiliaria');
	define('config_host','localhost');
	define('config_usuario','postgres');
	define('config_senha','postgres');

	define('config_msn_edit', 'Registro alterado com sucesso');
	define('config_msg_incluir','Registro incluído com sucesso.');
	define('config_msg_excluir','Registro excluído com sucesso.');
	define('config_msg_erro','Erro, a ação solicitada n�o foi realizada.');
	define('config_msg_integridade','Erro, este registro nao pode ser excluído, existem dados agregados a ele.');
	define('config_msg_existe','Erro, registro ja cadastrado.');
	define('config_msg_acesso','Acesso negado!\nDados invalidos.');

	define('config_img_tamanho',1000000);
	define('config_reg_pagina',10);
	define('config_msg_extensao','Arquivo invalido!\nSomente sao aceitos arquivos de imagens.');
	define('config_msg_tamanho','Tamanho do arquivo maior que o permitido.');
	define('config_msg_enviada','Imagem enviada ao servidor com sucesso.');

	

?>