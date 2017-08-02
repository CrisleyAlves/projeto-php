<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=operacao";
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
<h4 class="col m12">CADASTRO DE OPERAÇÕES</h4>

<form class="col s12 m12" name="frm_tipo" id="frm_tipo" method="post" action="index.php" enctype="multipart/form-data">
	<div class="input-field col s12 m12">
		<input type="text" name="ope_nome" id="ope_nome" maxlength="200" size="50" value="<?php echo isset($mod->reg->OPE_NOME)? $mod->reg->OPE_NOME: '';?>" placeholder="Informe o tipo">
	</div>
	<!-- QUEBRA DE LINHA !-->
	<p class="button">
		<input class="btn green col s12 m2" type="submit" value="SALVAR" class="salvar">
		<input class="btn grey col s12 m2" type="reset" value="LIMPAR" class="limpar">
		<input class="btn red col s12 m2" type="button" value="CANCELAR" class="open cancelar" onclick="cancela();">
		
		<input type="hidden" name="menu" value="<?php echo $menu?>">
		<input type="hidden" name="acao" value="gravar_<?=$acao;?>">
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->OPE_CODIGO)? $mod->reg->OPE_CODIGO: ''; ?>">
	</p>
</form>
</div>