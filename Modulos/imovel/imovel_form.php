<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=imovel";
	}

	function verifica(){
		var imo_endereco = document.getElementById('imo_endereco').value;
		var imo_descricao = document.getElementById('imo_descricao').value;
		var imo_quartos = document.getElementById('imo_quartos').value;
		var imo_valor = document.getElementById('imo_valor').value;
		var imo_condominio = document.getElementById('imo_condominio').value;

		if(imo_endereco == ""){
			alert("Informe o endereço");
			document.getElementById('imo_endereco').focus();
			return false;
		}else if(imo_descricao == ""){
			alert("Informe a descrição");
			document.getElementById('imo_descricao').focus();
			return false;
		}else if(imo_quartos == ""){
			alert("Informe a quantidade de quartos");
			document.getElementById('imo_quartos').focus();
			return false;
		}else if(imo_valor == ""){
			alert("Informe o valor");
			document.getElementById('imo_valor').focus();
			return false;
		}else if(imo_condominio == ""){
			alert("Informe o valor do condominio");
			document.getElementById('imo_condominio').focus();
			return false;
		}else{
			return true;
		}
	}

</script>

<div class="row">
<h4 class="col m12">CADASTRO DE IMÓVEL</h4>

<form class="col s12 m12" name="frm_imovel" id="frm_imovel" method="post" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	<div class="input-field col s12 m12">
		Endereço
		<input type="text" name="imo_endereco" id="imo_endereco" maxlength="200" size="50" value="<?php echo isset($mod->reg->IMO_ENDERECO)? $mod->reg->IMO_ENDERECO: '';?>" placeholder="Informe o endereço">
	</div>

	<div class="input-field col s12 m12">
		Descrição
		<input type="text" name="imo_descricao" id="imo_descricao" maxlength="200" size="50" value="<?php echo isset($mod->reg->IMO_DESCRICAO)? $mod->reg->IMO_DESCRICAO: '';?>" placeholder="Informe a descrição">
	</div>


	<div class="input-field col s12 m12">
		Quartos
		<input type="number" name="imo_quartos" id="imo_quartos" maxlength="200" size="50" value="<?php echo isset($mod->reg->IMO_QUARTOS)? $mod->reg->IMO_QUARTOS: '';?>">
	</div>

	<div class="input-field col s12 m12">
		Valor
		<input type="text" name="imo_valor" id="imo_valor" maxlength="200" size="50" value="<?php echo isset($mod->reg->IMO_VALOR)? $mod->reg->IMO_VALOR: '';?>" placeholder="Informe o valor">
	</div>

	<div class="input-field col s12 m12">
		Condominio
		<input type="text" name="imo_condominio" id="imo_condominio" maxlength="200" size="50" value="<?php echo isset($mod->reg->IMO_CONDOMINIO)? $mod->reg->IMO_CONDOMINIO: '';?>" placeholder="Informe o valor do condominio">
	</div>

	<div class="input-field col s12 m12">
		Proprietario
		<select name="pro_codigo" id="pro_codigo">
		<?php echo $mod->lista_proprietarios($acao == 'alterar' ? $mod->reg->PRO_CODIGO:'');?>
		</select>
	</div>

	<div class="input-field col s12 m12">
		Operação
		<select name="ope_codigo" id="ope_codigo">
			<?php echo $mod->lista_operacoes($acao == 'alterar' ? $mod->reg->OPE_CODIGO:'');?>
		</select>
	</div>

	<div class="input-field col s12 m12">
		<select name="tip_imovel" id="tip_imovel">
		<?php echo $mod->lista_tipos($acao == 'alterar' ? $mod->reg->TIP_CODIGO:'');?>
		</select>
	</div>

	<div class="input-field col s12 m12">
		<select name="bai_codigo" id="bai_codigo">
		<?php echo $mod->lista_bairros($acao == 'alterar' ? $mod->reg->BAI_CODIGO:'');?>
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
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->IMO_CODIGO)? $mod->reg->IMO_CODIGO: ''; ?>">
	</p>
	
</form>

</div>