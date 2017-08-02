<?php
	class foto{
	
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
		$this->sql = "SELECT * FROM tbl_fotos fot, tbl_imoveis imo WHERE fot.imo_codigo = imo.imo_codigo";
		if(isset($_GET['pg'])){
			$this->pg = $_GET['pg'];
		}else{
			$this->pg = 1;
		}
		$this->res = $this->con->bd->PageExecute($this->sql, config_reg_pagina, $this->pg);
	}

	function editar($id){
		$this->sql = "SELECT * FROM tbl_fotos WHERE fot_codigo = ".$id;
		$this->res = $this->con->bd->Execute($this->sql);
		$this->reg = $this->res->FetchNextObject();
	}

	function maximo(){
		$this->sql = "SELECT MAX(fot_codigo) FROM tbl_fotos";
	   	$this->res = $this->con->bd->Execute($this->sql);
	   	$reg = $this->res->FetchNextObject();
	   	return $reg->MAX;
	}

	function incluir($imo_codigo, $f_imagem){
		
			$ext_arquivo = strrchr($f_imagem, '.');
			$ultimo = $this->maximo();
			//vai inserir como nome o mesmo nome do arquivo que está no upload, ou seja, cod_imovel+nomeArquivo
			$this->sql = "INSERT INTO tbl_fotos(imo_codigo, fot_nome) VALUES($imo_codigo, '".$imo_codigo."_".$ultimo.$ext_arquivo."')";
			if($this->con->bd->Execute($this->sql)){
				if (move_uploaded_file($_FILES['f_imagem']['tmp_name'], 'img/'.$imo_codigo."_".$ultimo.$ext_arquivo)){
	                $msg = config_msg_enviada;
	            }
				return true;
			}else{
				return false;
			}
	}

	function alterar($fot_codigo, $fot_nome, $imo_codigo){
		$ext_arquivo = strrchr($fot_nome, '.');
		$ultimo = $this->maximo();

		if($fot_nome == ""){
			$this->sql = "UPDATE tbl_fotos set imo_codigo = $imo_codigo WHERE fot_codigo = $fot_codigo";
			if($this->con->bd->Execute($this->sql)){
				return true;
			}
			else{
				return false;
			}
		}else{
			$this->sql = "UPDATE tbl_fotos SET fot_nome = '".$imo_codigo."_".$ultimo.$ext_arquivo."', imo_codigo = $imo_codigo WHERE fot_codigo = $fot_codigo";	
			if($this->con->bd->Execute($this->sql)){
			/*
				Quando alterar alguma imagem do banco tem que excluir a imagem anterior e atualizar pela nova
			*/
			if (move_uploaded_file($_FILES['f_imagem']['tmp_name'], 'img/'.$imo_codigo."_".$ultimo.$ext_arquivo)) {
                $msg = config_msg_enviada;
            }
			return true;
			}else{
				return false;
			}
		}
	}

	function excluir($id, $nomeImagem){
		$this->sql = "DELETE FROM tbl_fotos WHERE fot_codigo =".$id;
		if($this->con->bd->Execute($this->sql)){
				unlink('img/'.$nomeImagem);
				//unlink elimina um arquivo do servidor;
			return true;
		}else{
			return false;
		}
	}

	function total(){
		$this->sql = "SELECT * FROM tbl_fotos";
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
			$retorno .= '[ <a href="?menu=foto&acao=listar';
			$retorno .= '&pg='.$pagina.'">'.$pagina.'</a> ]';
			$pagina++;

		}
		return $retorno;
	}

	function lista_imoveis($op){
		$sql = "SELECT * FROM tbl_imoveis";
		$res = $this->con->bd->Execute($sql);
		$retorno = "";
		while($reg = $res->FetchNextObject()){
			$selecionado = 'selected';
			if($op == $reg->IMO_CODIGO){
				$retorno .= '<option value="'.$reg->IMO_CODIGO.'" '.$selecionado.'>'.$reg->IMO_DESCRICAO.'</option>';
			}else{
				$retorno .= '<option value="'.$reg->IMO_CODIGO.'" >'.$reg->IMO_DESCRICAO.'</option>';
			}
		}
		return $retorno;
	}
}
?>