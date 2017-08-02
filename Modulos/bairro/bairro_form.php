<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=bairro";
	}

	function verifica(){
		var bairro = document.getElementById('bai_nome').value;

		if(bairro == ""){
			alert("Informe o bairro");
			document.getElementById('bai_nome').focus();
			return false;
		}else{
			return true;
		}
	}

</script>
<div class="row">
<h4 class="col m12">CADASTRO DE BAIRROS</h4>

<form class="col s12 m12" name="frm_bairro" id="frm_bairro" method="post" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	<div class="input-field col s12 m12">
		NOME
		<input type="text" name="bai_nome" id="bai_nome" maxlength="200" size="50" value="<?php echo isset($mod->reg->BAI_NOME)? $mod->reg->BAI_NOME: '';?>" placeholder="Informe o nome do bairro">
	</div>

	<div class="input-field col s12 m12">
		Cidade
		<select name="cid_codigo" id="cid_codigo">
			<?php echo $mod->lista_cidades($acao == 'alterar' ? $mod->reg->COD_CIDADE:'');?>
		</select>
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
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->BAI_CODIGO)? $mod->reg->BAI_CODIGO: ''; ?>">
	</p>
	
</form>
</div>