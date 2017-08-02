<?php
	require('config.php');
	require('biblioteca/adodb/adodb.inc.php');
	require('conecta.php');
	require('funcoes.php');

	

	if(isset($_POST['f_email'])){
		$email = $_POST['f_email'];	
		$con = new conecta();

		$sql = "SELECT * FROM tbl_administradores WHERE adm_email = '".$email."'";
		$res = $con->bd->Execute($sql);
		
		if($reg = $res->FetchNextObject()){
			echo "<script>alert('A senha foi enviada por email')</script>";
			$loginMensagem = "Login: ".$reg->ADM_LOGIN."\n";
			$loginMensagem .= "Senha: ".$reg->ADM_SENHA."\n";
			$loginMensagem = wordwrap($loginMensagem,70);
			mail($email, "Senha", $loginMensagem);
			//redireciona("index.php");
		}else{
			echo "<script>alert('email invalido, contate o Crisley')</script>";
			redireciona("index.php");
		}
	}

	
?>