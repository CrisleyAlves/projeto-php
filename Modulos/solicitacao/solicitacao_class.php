<?php
	class solicitacao{
	
	var $sql; // sql, dã
	var $res; // resultado do sql
	var $reg; // recebe dados do banco
	var $con; // conecta com o banco
	var $total_pg; // total de paginas para fazer paginação
	var $pg; // que pagina a gente está visualizando no momento


	function __construct(){
		$this->con = new conecta();
	}

	function incluir($sol_nome, $sol_assunto, $cod_imovel, $sol_contato, $sol_email, $sol_mensagem){
		$this->sql =" INSERT INTO tbl_solicitacoes (sol_nome, sol_assunto, sol_imovel, sol_contato, sol_email, sol_mensagem, sol_status)VALUES('".$sol_nome."','".$sol_assunto."', ".$cod_imovel.", '".$sol_contato."', '".$sol_email."', '".$sol_mensagem."', 'I')";

		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}

	}

	function listar(){

		$this->total_pg = ceil($this->total() / config_reg_pagina);		
		$this->sql = "SELECT * FROM tbl_solicitacoes sol, tbl_imoveis imo 
		WHERE sol.sol_imovel = imo.imo_codigo";

		if(isset($_GET['f_busca'])!= "")
		$this->sql .= " AND upper(SOL_NOME) like upper('%".$_GET['f_busca']."%')";
		
		if(isset($_GET['ord']))
		{
			switch ($_GET['ord']) {
				case 1:
				$this->sql .= " order by SOL_CODIGO";
				break;

				case 2:
				$this->sql .= " order by SOL_NOME";
				break;

				case 3:
				$this->sql .= " order by imo.IMO_CODIGO";
				break;

				case 4:
				$this->sql .= " order by SOL_STATUS";
				break;

				default:
				$this->sql .= " order by SOL_CODIGO";
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
		$this->sql = "select * from tbl_solicitacoes where sol_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function alterar($sol_codigo, $sol_nome, $sol_assunto, $cod_imovel, $sol_contato, $sol_email, $sol_mensagem){
		$this->sql = "UPDATE tbl_solicitacoes set sol_nome = '".$sol_nome."',
		sol_assunto = '".$sol_assunto."', cod_imovel = ".$cod_imovel.", sol_contato = '".$sol_contato."', 
		sol_email = '".$sol_email."', sol_mensagem = '".$sol_mensagem."' WHERE sol_codigo = $sol_codigo";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function excluir($id){
		$this->sql = "DELETE FROM tbl_solicitacoes WHERE sol_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "select * from tbl_solicitacoes";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	/*
	function verifica($nome){
		$this->sql = "select * from tbl_bairros where lower(cid_nome) = lower('".$nome."')";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function verifica2($nome, $id){
		$this->sql = "select * from tbl_cidades where lower(cid_nome) = lower('".$nome."')
		and cid_codigo != ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}
	*/

	function paginacao(){
		$retorno = '';
		$pagina = 1;
		while($pagina <= $this->total_pg){
						$retorno .= '[ <a href="?menu=solicitacao&acao=listar';
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