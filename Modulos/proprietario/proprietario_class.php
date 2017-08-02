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
		$this->sql = "select * from tbl_proprietarios";

		if(isset($_GET['f_busca'])!= "" && $_GET['op']){
			if($_GET['op'] == "nome"){
			$this->sql .= " where upper(PRO_NOME) like upper('%".$_GET['f_busca']."%')";
			}else if($_GET['op'] == "cpf"){
				$this->sql .= " where upper(PRO_CPF) like upper('%".$_GET['f_busca']."%')";
			}else{
				$this->sql .= " where upper(PRO_RG) like upper('%".$_GET['f_busca']."%')";
			}
		}
		
		if(isset($_GET['ord']))
		{
			switch ($_GET['ord']) {
				case 1:
				$this->sql .= " order by PRO_CODIGO";
				break;

				case 2:
				$this->sql .= " order by PRO_NOME";
				break;

				case 3:
				$this->sql .= " order by PRO_EMAIL";
				break;

				case 4:
				$this->sql .= " order by PRO_CONTATO";
				break;

				default:
				$this->sql .= " order by PRO_CODIGO";
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
		$this->sql = "select * from tbl_proprietarios where pro_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function incluir($pro_nome, $pro_cpf, $pro_rg, $pro_email, $pro_contato){
		$this->sql = "INSERT INTO tbl_proprietarios(pro_nome, pro_cpf, pro_rg, pro_email, pro_contato)
		VALUES('$pro_nome', '$pro_cpf', '$pro_rg', '$pro_email', '$pro_contato')";

		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function alterar($pro_codigo, $pro_nome, $pro_cpf, $pro_rg, $pro_email, $pro_contato){
		$this->sql = "UPDATE tbl_proprietarios set pro_nome = '".$pro_nome."', pro_cpf = '".$pro_cpf."',
		pro_rg = '".$pro_rg."', pro_email = '".$pro_email."', pro_contato = '".$pro_contato."' 
		WHERE pro_codigo = ".$pro_codigo."";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function excluir($id){
		$this->sql = "DELETE FROM tbl_proprietarios WHERE pro_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "select * from tbl_proprietarios";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function paginacao(){
			$retorno = '';
		$pagina = 1;
		while($pagina <= $this->total_pg){
						$retorno .= '[ <a href="?menu=proprietario&acao=listar';
			if(isset($_GET['f_busca']))
				$retorno .= '&f_busca='.$_GET['f_busca'];
			if(isset($_GET['ord']))
				$retorno .= '&ord='.$_GET['ord'];
			$retorno .= '&pg='.$pagina.'">'.$pagina.'</a> ]';
			$pagina++;

		}
		return $retorno;
	}

	function repetidoCpf($pro_cpf){
		$this->sql = "SELECT * FROM tbl_proprietarios WHERE lower(PRO_CPF) = lower('".$pro_cpf."')";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function repetidoRg($pro_rg){
		$this->sql = "SELECT * FROM tbl_proprietarios WHERE lower(PRO_RG) = lower('".$pro_rg."')";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}
}
?>