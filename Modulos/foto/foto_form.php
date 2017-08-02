<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=foto";
	}

</script>
<div class="row">
<h4 class="col m12">CADASTRO DE FOTOS</h4>

<form class="col s12 m12" name="frm_foto" id="frm_foto" method="post" action="index.php" enctype="multipart/form-data">

	<div class="input-field col s12 m12">
		<input type="file" name="f_imagem" id="f_imagem" value="">
	</div>

	<div class="input-field col s12 m12">
		Imóveis
		<select name="imo_codigo" id="imo_codigo">
			<?php echo $mod->lista_imoveis($acao == 'alterar'? $mod->reg->IMO_CODIGO: '');?>
		</select>
	</div>

	<p class="button">
		<input class="btn green col s12 m2" type="submit" value="SALVAR" class="salvar">
		<input class="btn grey col s12 m2" type="reset" value="LIMPAR" class="limpar">
		<input class="btn red col s12 m2" type="button" value="CANCELAR" class="open cancelar" onclick="cancela();">
		
		<input type="hidden" name="menu" value="<?php echo $menu?>">
		<input type="hidden" name="acao" value="gravar_<?=$acao;?>">
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->FOT_CODIGO)? $mod->reg->FOT_CODIGO: ''; ?>">
	</p>
	
</form>

</div>