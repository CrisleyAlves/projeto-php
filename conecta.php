<?php

	class conecta{
		var $bd;

		function __construct(){
			//adiciona banco
			$this->bd = ADONewConnection(config_bd);
			$this->bd->dialect = 3;
			$this->bd->debug = false;
			$this->bd->Connect(config_host, config_usuario, config_senha, config_bd_nome);
		}
	}

?>