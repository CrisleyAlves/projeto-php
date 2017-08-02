<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=tipo";
	}

	function verifica(){
		var tipo = document.getElementById('tip_nome').value;

		if(tipo == ""){
			alert("Informe o tipo");
			document.getElementById('tip_nome').focus();
			return false;
		}else{
			return true;
		}
	}

</script>
<div class="row">
<h4 class="col m12">CADASTRO DE TIPOS</h4>

<form class="col s12 m12" name="frm_tipo" id="frm_tipo" method="post" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	<div class="input-field col s12 m12">
		<input type="text" name="tip_nome" id="tip_nome" maxlength="200" size="50" value="<?php echo isset($mod->reg->TIP_NOME)? $mod->reg->TIP_NOME: '';?>" placeholder="Informe o tipo">
	</div>
	

	<p class="button">
		<input class="btn green col s12 m2" type="submit" value="SALVAR" class="salvar">
		<input class="btn grey col s12 m2" type="reset" value="LIMPAR" class="limpar">
		<input class="btn red col s12 m2" type="button" value="CANCELAR" class="open cancelar" onclick="cancela();">
		
		<input type="hidden" name="menu" value="<?php echo $menu?>">
		<input type="hidden" name="acao" value="gravar_<?=$acao;?>">
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->TIP_CODIGO)? $mod->reg->TIP_CODIGO: ''; ?>"
	</p>
	
</form>

</div>