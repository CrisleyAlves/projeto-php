<?php
	class cidade{
	
	var $sql; // sql, dã
	var $res; // resultado do sql
	var $reg; // recebe dados do banco
	var $con; // conecta com o banco
	var $total_pg; // total de paginas para fazer paginação
	var $pg; // que pagina a gente está visualizando no momento


	function __construct(){
		$this->con = new conecta();
	}

	function listar(){

		$this->total_pg = ceil($this->total() / config_reg_pagina);		
		$this->sql = "SELECT * FROM tbl_cidades";

		if(isset($_GET['f_busca']))
		{
			if($_GET['op'] == "cidade"){
				$this->sql .= " where upper(CID_NOME) like upper('%".$_GET['f_busca']."%')";
			}else{
				$this->sql .= " where upper(CID_UF) like upper('%".$_GET['f_busca']."%')";
			}
		}
		
		
		if(isset($_GET['ord']))
		{
			switch ($_GET['ord']) {
				case 1:
				$this->sql .= " order by CID_CODIGO";
				break;

				case 2:
				$this->sql .= " order by CID_NOME";
				break;

				case 3:
				$this->sql .= " order by CID_UF";
				break;

				default:
				$this->sql .= " order by CID_CODIGO";
				break;
			}
		}


		if(isset($_GET['pg'])){
			$this->pg = $_GET['pg'];
		}else{
			$this->pg = 1;
		}
		$this->res = $this->con->bd->PageExecute($this->sql, config_reg_pagina, $this->pg);
	}

	function editar($id){
		$this->sql = "SELECT * FROM tbl_cidades WHERE cid_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function incluir($nome, $uf){
		$this->sql = "INSERT INTO tbl_cidades(cid_nome, cid_uf) VALUES('$nome','$uf')";

		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function alterar($nome, $uf, $id){
		$this->sql = "UPDATE tbl_cidades set cid_nome = '".$nome."', cid_uf = '".$uf."' WHERE cid_codigo = $id";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function excluir($id){
		$this->sql = "DELETE FROM tbl_cidades WHERE cid_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "SELECT * FROM tbl_cidades";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function verifica($nome){
		$this->sql = "SELECT * FROM tbl_cidades WHERE lower(cid_nome) = lower('".$nome."')";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function verifica2($nome, $id){
		$this->sql = "SELECT * FROM tbl_cidades WHERE lower(cid_nome) = lower('".$nome."')
		and cid_codigo != ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function paginacao(){
		$retorno = '';
		$pagina = 1;
		while($pagina <= $this->total_pg){
			$retorno .= '[ <a href="?menu=cidade&acao=listar';
			if(isset($_GET['f_busca']))
				$retorno .= '&f_busca='.$_GET['f_busca'];
			if(isset($_GET['ord']))
				$retorno .= '&ord='.$_GET['ord'];
			$retorno .= '&pg='.$pagina.'">'.$pagina.'</a> ]';
			$pagina++;

		}
		return $retorno;
	}
}
?>