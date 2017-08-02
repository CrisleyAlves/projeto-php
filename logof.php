<?php

	session_start();
	require('funcoes.php');
	unset($_SESSION['adm_codigo']);
	unset($_SESSION['adm_nome']);
	unset($_SESSION['adm_usuario']);
	unset($_SESSION['adm_senha']);
	session_destroy();
	redireciona("index.php");
	exit();
?>