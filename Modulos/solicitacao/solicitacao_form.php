<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=solicitacao";
	}

</script>

<div class="row">
<h4 class="col m12">SOLICITAÇÕES</h4>

<form class="col s12 m12" name="frm_solicitacao" id="frm_solicitacao" method="post" action="index.php" enctype="multipart/form-data">
	
	<div class="input-field col s12 m12">
		Nome
		<input type="text" name="sol_nome" id="sol_nome" maxlength="200" size="50" value="<?php echo isset($mod->reg->SOL_NOME)? $mod->reg->SOL_NOME: '';?>">
	</div>

	<div class="input-field col s12 m12">
		Assunto
		<input type="text" name="sol_assunto" id="sol_assunto" maxlength="200" size="50" value="<?php echo isset($mod->reg->SOL_ASSUNTO)? $mod->reg->SOL_ASSUNTO: '';?>">
	</div>

	<div class="input-field col s12 m12">
		Imovel
		<input type="text" name="cod_imovel" id="cod_imovel" maxlength="200" size="50" value="<?php echo isset($mod->reg->SOL_IMOVEL)? $mod->reg->SOL_IMOVEL: '';?>">
	</div>

	<div class="input-field col s12 m12">
		Contato
		<input type="text" name="sol_contato" id="sol_contato" maxlength="200" size="50" value="<?php echo isset($mod->reg->SOL_CONTATO)? $mod->reg->SOL_CONTATO: '';?>">
	</div>

	<div class="input-field col s12 m12">
		Email
		<input type="text" name="sol_email" id="sol_email" maxlength="200" size="50" value="<?php echo isset($mod->reg->SOL_EMAIL)? $mod->reg->SOL_EMAIL: '';?>">
	</div>

	<div class="input-field col s12 m12">
		Mensagem
		<input type="text" name="sol_mensagem" id="sol_mensagem" maxlength="200" size="50" value="<?php echo isset($mod->reg->SOL_MENSAGEM)? $mod->reg->SOL_MENSAGEM: '';?>">
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
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->SOL_CODIGO)? $mod->reg->SOL_CODIGO: ''; ?>">
	</p>
	
</form>

</div>