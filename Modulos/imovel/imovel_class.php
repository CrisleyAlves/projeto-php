<?php
	class imovel{
	
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
		$this->sql = "SELECT * FROM tbl_imoveis imo, tbl_bairros bai, tbl_proprietarios pro, tbl_operacoes ope, tbl_tipos tip WHERE	imo.PRO_CODIGO = pro.PRO_CODIGO AND imo.TIP_CODIGO = tip.TIP_CODIGO AND ope.ope_codigo = imo.ope_codigo AND imo.bai_codigo = bai.bai_codigo";


		if(isset($_GET['f_busca'])!= ""){
			$_GET['f_busca'] = str_replace("'", "", $_GET['f_busca']);

			if($_GET['op'] == "codigo"){
				if(!is_numeric($_GET['f_busca'])){
					$_GET['f_busca'] = 0;
				}
				$this->sql .= " AND IMO_CODIGO = ".$_GET['f_busca'];
			}else if($_GET['op'] == "endereco"){
				$this->sql .= " AND upper(IMO_ENDERECO) like upper('%".$_GET['f_busca']."%')";
			}else if($_GET['op'] == "bairro"){
				$this->sql .= " AND upper(BAI_NOME) like upper('%".$_GET['f_busca']."%')";
			}else if($_GET['op'] == "operacao"){
				$this->sql .= " AND upper(OPE_NOME) like upper('%".$_GET['f_busca']."%')";
			}else if($_GET['op'] == "proprietario"){
				$this->sql .= " AND upper(PRO_NOME) like upper('%".$_GET['f_busca']."%')";
			}
			else{
				$this->sql .= " AND upper(TIP_NOME) like upper('%".$_GET['f_busca']."%')";
			}
		}

		if(isset($_GET['ord']))
		{
			switch ($_GET['ord']) {
				case 1:
				$this->sql .= " ORDER BY IMO_CODIGO";
				break;

				case 2:
				$this->sql .= " ORDER BY IMO_ENDERECO";
				break;

				case 3:
				$this->sql .= " ORDER BY IMO_DESCRICAO";
				break;

				case 4:
				$this->sql .= " ORDER BY bai.BAI_NOME";
				break;

				case 5:
				$this->sql .= " ORDER BY OPE_NOME";
				break;

				case 6:
				$this->sql .= " ORDER BY IMO_VALOR";
				break;

				case 7:
				$this->sql .= " ORDER BY imo.TIP_CODIGO";
				break;

				default:
				$this->sql .= " ORDER BY IMO_CODIGO";
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
		$this->sql = "SELECT * FROM tbl_imoveis WHERE imo_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function incluir($imo_endereco,$imo_descricao, $imo_quartos, $imo_valor, $imo_condominio, $pro_codigo, $tip_codigo, $ope_codigo, $bai_codigo){
		$this->sql = "INSERT INTO tbl_imoveis(imo_endereco, imo_descricao, imo_quartos, imo_valor, imo_condominio, pro_codigo, tip_codigo, ope_codigo, bai_codigo)
		VALUES('$imo_endereco','$imo_descricao', $imo_quartos,$imo_valor,$imo_condominio,$pro_codigo,$tip_codigo, $ope_codigo, $bai_codigo)";

		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function alterar($imo_codigo, $imo_endereco, $imo_descricao, $imo_quartos, $imo_valor, $imo_condominio, $pro_codigo, $tip_codigo, $ope_codigo, $bai_codigo){
		$this->sql = "UPDATE tbl_imoveis SET imo_endereco = '".$imo_endereco."', imo_descricao = '".$imo_descricao."',
		imo_quartos = ".$imo_quartos.", imo_valor = ".$imo_valor.", imo_condominio = ".$imo_condominio.", 
		pro_codigo = ".$pro_codigo.", tip_codigo = ".$tip_codigo.", ope_codigo =".$ope_codigo.", bai_codigo = ".$bai_codigo." WHERE imo_codigo = ".$imo_codigo."";
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function excluir($id){
		$this->sql = "DELETE FROM tbl_imoveis WHERE imo_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "SELECT * FROM tbl_imoveis";
		$this->res = $this->con->bd->Execute($this->sql);
		return $this->res->RecordCount();
	}

	function paginacao(){
		$retorno = '';
		$pagina = 1;
		while($pagina <= $this->total_pg){
						$retorno .= '[ <a href="?menu=imovel&acao=listar';
			if(isset($_GET['f_busca']))
				$retorno .= '&f_busca='.$_GET['f_busca'];
			if(isset($_GET['ord']))
				$retorno .= '&ord='.$_GET['ord'];
			$retorno .= '&pg='.$pagina.'">'.$pagina.'</a> ]';
			$pagina++;

		}
		return $retorno;
	}

	function lista_proprietarios($op){
		$sql = "SELECT * FROM tbl_proprietarios";
		$res = $this->con->bd->Execute($sql);
		$retorno = "";
		while($reg = $res->FetchNextObject()){
			$selecionado = 'selected';
			if($op == $reg->PRO_CODIGO){
				$retorno .= '<option value="'.$reg->PRO_CODIGO.'" '.$selecionado.'>'.$reg->PRO_NOME.'</option>';
			}else{
				$retorno .= '<option value="'.$reg->PRO_CODIGO.'" >'.$reg->PRO_NOME.'</option>';
			}
		}
		return $retorno;
	}

	function lista_tipos($op){
		$sql = "SELECT * FROM tbl_tipos";
		$res = $this->con->bd->Execute($sql);
		$retorno = "";
		while($reg = $res->FetchNextObject()){
			$selecionado = 'selected';
			if($op == $reg->TIP_CODIGO){
				$retorno .= '<option value="'.$reg->TIP_CODIGO.'" '.$selecionado.'>'.$reg->TIP_NOME.'</option>';
			}else{
				$retorno .= '<option value="'.$reg->TIP_CODIGO.'" >'.$reg->TIP_NOME.'</option>';
			}
		}
		return $retorno;
	}

	function lista_bairros($op){
		$sql = "SELECT * FROM tbl_bairros";
		$res = $this->con->bd->Execute($sql);
		$retorno = "";
		while($reg = $res->FetchNextObject()){
			$selecionado = 'selected';
			if($op == $reg->BAI_CODIGO){
				$retorno .= '<option value="'.$reg->BAI_CODIGO.'" '.$selecionado.'>'.$reg->BAI_NOME.'</option>';
			}else{
				$retorno .= '<option value="'.$reg->BAI_CODIGO.'" >'.$reg->BAI_NOME.'</option>';
			}
		}
		return $retorno;
	}

	function lista_operacoes($op){
		$sql = "SELECT * FROM tbl_operacoes";
		$res = $this->con->bd->Execute($sql);
		$retorno = "";
		while($reg = $res->FetchNextObject()){
			$selecionado = 'selected';
			if($op == $reg->OPE_CODIGO){
				$retorno .= '<option value="'.$reg->OPE_CODIGO.'" '.$selecionado.'>'.$reg->OPE_NOME.'</option>';
			}else{
				$retorno .= '<option value="'.$reg->OPE_CODIGO.'" >'.$reg->OPE_NOME.'</option>';
			}
		}
		return $retorno;
	}
}
?>