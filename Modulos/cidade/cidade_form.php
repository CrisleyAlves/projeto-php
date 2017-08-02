<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=cidade";
	}

	function verifica(){
		var cidade = document.getElementById('cid_nome').value;
		var uf = document.getElementById('cid_uf').value;

		if(cidade == ""){
			alert("Informe a cidade");
			document.getElementById('cid_nome').focus();
			return false;
		}else if(uf == ""){
			alert("Informe a uf");
			document.getElementById('cid_uf').focus();
			return false;
		}else if(uf.length > 2){
			alert("UF INVÁLIDO");
			document.getElementById('cid_uf').focus();
			return false;
		}
		else{
			return true;
		}
	}

</script>

<div class="row">
<h4 class="col m12">CADASTRO DE CIDADES</h4>

<form name="frm_cidade" id="frm_cidade" method="post" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	
		<div class="input-field col s12 m12">
		Nome
		<input type="text" name="cid_nome" id="cid_nome" maxlength="200" size="50" value="<?php echo isset($mod->reg->CID_NOME)? $mod->reg->CID_NOME: '';?>">
		</div>
	
		<div class="input-field col s12 m12">
		Uf
		<input type="text" name="cid_uf" id="cid_uf" maxlength="200" size="2" value="<?php echo isset($mod->reg->CID_UF)? $mod->reg->CID_UF: '';?>">
		</div>

	<!-- QUEBRA DE LINHA !-->
	<div class="clear"></div> 
	<div class="clear"></div>

	<p class="button">
		<input class="btn green col s12 m2" type="submit" value="SALVAR" class="salvar">
		<input class="btn grey col s12 m2" type="reset" value="LIMPAR" class="limpar">
		<input class="btn red col s12 m2" type="button" value="CANCELAR" class="open cancelar" onclick="cancela();">
		
		<input type="hidden" name="menu" value="<?php echo $menu?>">
		<input type="hidden" name="acao" value="gravar_<?=$acao;?>">
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->CID_CODIGO)? $mod->reg->CID_CODIGO: ''; ?>">
	</p>
	
</form>

</div>