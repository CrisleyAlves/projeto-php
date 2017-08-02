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
		$this->sql = "SELECT * FROM tbl_bairros bai, tbl_cidades cid 
		WHERE bai.cod_cidade = cid.cid_codigo";

		if(isset($_GET['f_busca'])!= ""){
			if($_GET['op'] == "bairro"){
				$this->sql .= " AND upper(BAI_NOME) like upper('%".$_GET['f_busca']."%')";
			}else{
				$this->sql .= " AND upper(CID_NOME) like upper('%".$_GET['f_busca']."%')";
			}
		}
		
		if(isset($_GET['ord']))
		{
			switch ($_GET['ord']) {
				case 1:
				$this->sql .= " order by BAI_CODIGO";
				break;

				case 2:
				$this->sql .= " order by BAI_NOME";
				break;

				default:
				$this->sql .= " order by BAI_NOME";
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
		$this->sql = "SELECT * FROM tbl_bairros WHERE bai_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function incluir($bai_nome, $cod_cidade){
		$this->sql = "INSERT INTO tbl_bairros(bai_nome, cod_cidade) VALUES('$bai_nome', $cod_cidade)";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function alterar($bai_codigo, $bai_nome, $cod_cidade){
		$this->sql = "UPDATE tbl_bairros set bai_nome = '".$bai_nome."', cod_cidade = $cod_cidade WHERE bai_codigo = $bai_codigo";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function excluir($id){
		$this->sql = "DELETE FROM tbl_bairros WHERE bai_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "SELECT * FROM tbl_bairros";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	
	function repetido($nome, $cod_cidade){
		$this->sql = "SELECT * FROM tbl_bairros bai, tbl_cidades cid WHERE lower(bai.BAI_NOME) = lower('".$nome."') AND bai.cod_cidade = ".$cod_cidade;
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function paginacao(){
		$retorno = '';
		$pagina = 1;
		while($pagina <= $this->total_pg){
						$retorno .= '[ <a href="?menu=bairro&acao=listar';
			if(isset($_GET['f_busca']))
				$retorno .= '&f_busca='.$_GET['f_busca'];
			if(isset($_GET['ord']))
				$retorno .= '&ord='.$_GET['ord'];
			$retorno .= '&pg='.$pagina.'">'.$pagina.'</a> ]';
			$pagina++;

		}
		return $retorno;
	}

	function lista_cidades($op){
		$sql = "SELECT * FROM tbl_cidades";
		$res = $this->con->bd->Execute($sql);
		$retorno = "";
		while($reg = $res->FetchNextObject()){
			$selecionado = 'selected';
			if($op == $reg->CID_CODIGO){
				$retorno .= '<option value="'.$reg->CID_CODIGO.'" '.$selecionado.'>'.$reg->CID_NOME.'</option>';
			}else{
				$retorno .= '<option value="'.$reg->CID_CODIGO.'" >'.$reg->CID_NOME.'</option>';
			}
		}
		return $retorno;
	}
}
?>