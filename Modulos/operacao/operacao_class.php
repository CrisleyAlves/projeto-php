<?php
	class operacao{
	
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
		$this->sql = "SELECT * FROM tbl_operacoes";

		if(isset($_GET['f_busca'])!= "")
		$this->sql .= " where upper(OPE_NOME) like upper('%".$_GET['f_busca']."%')";
		
		if(isset($_GET['ord']))
		{
			switch ($_GET['ord']) {
				case 1:
				$this->sql .= " order by OPE_CODIGO";
				break;

				case 2:
				$this->sql .= " order by OPE_NOME";
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
		$this->sql = "SELECT * FROM tbl_operacoes WHERE ope_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function incluir($ope_nome){
		$this->sql = "INSERT INTO tbl_operacoes(ope_nome) VALUES('$ope_nome')";

		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function alterar($ope_codigo, $ope_nome){
		$this->sql = "UPDATE tbl_operacoes SET ope_nome = '".$ope_nome."' WHERE ope_codigo = $ope_codigo";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function excluir($id){
		$this->sql = "DELETE FROM tbl_operacoes WHERE ope_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "SELECT * FROM tbl_operacoes";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function repetido($nome){
		$this->sql = "SELECT * FROM tbl_operacoes WHERE lower(OPE_NOME) = lower('".$nome."')";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function paginacao(){
		$retorno = '';
		$pagina = 1;
		while($pagina <= $this->total_pg){
						$retorno .= '[ <a href="?menu=operacao&acao=listar';
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