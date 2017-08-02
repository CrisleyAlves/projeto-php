<?php

	function mensagem($texto){
		echo "<script>";
		echo "alert('".$texto."')";
		echo "</script>";
	}

	function redireciona($url){
		echo "<script>";
		echo 'window.location="'.$url.'"';
		echo "</script>";
	}

	function inverte_data($dt, $a, $n){
		$vet = explode($a, $dt);
		return $vet[2].$n.$vet[1].$n.$vet[0];
	}
?>