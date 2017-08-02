<?php
	class bairro{
	
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
		$this->sql = "select * from tbl_tipos";

		if(isset($_GET['f_busca'])!= "")
		$this->sql .= " where upper(TIP_NOME) like upper('%".$_GET['f_busca']."%')";
		
		if(isset($_GET['ord']))
		{
			switch ($_GET['ord']) {
				case 1:
				$this->sql .= " order by TIP_CODIGO";
				break;

				case 2:
				$this->sql .= " order by TIP_NOME";
				break;

				default:
				$this->sql .= " order by TIP_NOME";
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
		$this->sql = "select * from tbl_tipos where tip_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function incluir($tip_nome){
		$this->sql = "INSERT INTO tbl_tipos(tip_nome) VALUES('$tip_nome')";

		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function alterar($tip_codigo, $tip_nome){
		$this->sql = "UPDATE tbl_tipos set tip_nome = '".$tip_nome."' WHERE tip_codigo = $tip_codigo";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function excluir($id){
		$this->sql = "DELETE FROM tbl_tipos WHERE tip_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "select * from tbl_tipos";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function repetido($nome){
		$this->sql = "SELECT * FROM tbl_tipos WHERE lower(TIP_NOME) = lower('".$nome."')";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function paginacao(){
		$retorno = '';
		$pagina = 1;
		while($pagina <= $this->total_pg){
						$retorno .= '[ <a href="?menu=tipo&acao=listar';
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