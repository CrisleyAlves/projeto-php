<script type="text/javascript">
	
	function cancela(){
		window.location = "?menu=proprietario";
	}

	function mascaraCpf(campoCPF, mascara){
        var campo = campoCPF.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(campo);
        if(texto.substring(0,1) != saida){
          campoCPF.value += texto.substring(0,1);
        }
     }

     function mascaraRg(campoRG, mascara){
     	var campo = campoRG.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(campo);
        if(texto.substring(0,1) != saida){
          campoRG.value += texto.substring(0,1);
        }	
     }

	function apenasNumeros(e){
		key = e.keyCode || e.which;

		teclado = String.fromCharCode(key);

		numeros = "0123456789";
		especial = "8-37-38-46";

		teclado_especial = false;

		for(var i in especial){
			if(key == especial[i]){
				teclado_especial = true;
			}
		}

		if(numeros.indexOf(teclado)==-1 && !teclado_especial){
			return false;
		}
	}

	function verifica(){
	
		var pro_nome = document.getElementById('pro_nome').value;
		var pro_cpf = document.getElementById('pro_cpf').value;
		var pro_rg = document.getElementById('pro_rg').value;
		var pro_email = document.getElementById('pro_email').value;
		var pro_contato = document.getElementById('pro_contato').value;

		if(pro_nome == ""){
			alert("Informe o nome do proprietario");
			document.getElementById('pro_nome').focus();
			return false;
		}else if(pro_cpf == ""){
			alert("Informe o cpf do proprietario");
			document.getElementById('pro_cpf').focus();
			return false;
		}else if(pro_rg == ""){
			alert("Informe o rg do proprietario");
			document.getElementById('pro_rg').focus();
			return false;
		}else if(pro_email == ""){
			alert("Informe o email do proprietario");
			document.getElementById('pro_email').focus();
			return false;
		}else if(pro_contato == ""){
			alert("Informe o contato do proprietario");
			document.getElementById('pro_contato').focus();
			return false;
		}else if((pro_cpf.length) < 13){
			alert("CPF INVALIDO");
			document.getElementById('pro_cpf').focus();
			return false;
		}else if((pro_rg.length) < 12){
			alert("RG INVALIDO");
			document.getElementById('pro_rg').focus();
			return false;
		}else{
			return true;
		}

	}
</script>

<div class="row">
<h4 class="col m12">CADASTRO DE PROPRIETARIO</h4>

<form name="frm_proprietario" id="frm_proprietario" method="post" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">

		<div class="input-field col s12 m12">
		NOME
		<input type="text" name="pro_nome" id="pro_nome" maxlength="200" size="50" value="<?php echo isset($mod->reg->PRO_NOME)? $mod->reg->PRO_NOME: '';?>">
		</div>

		<div class="input-field col s12 m12">
		CPF
		<input type="text" name="pro_cpf" id="pro_cpf" 	 maxlength="14" size="2" onkeypress="return apenasNumeros(event);" value="<?php echo isset($mod->reg->PRO_CPF)? $mod->reg->PRO_CPF: '';?>" >
		</div>

		<div class="input-field col s12 m12">
		RG
		<input type="text" name="pro_rg" id="pro_rg" maxlength="12" size="2" onkeypress="return apenasNumeros(event);" value="<?php echo isset($mod->reg->PRO_RG)? $mod->reg->PRO_RG: '';?>">
		</div>	

		<div class="input-field col s12 m12">
		EMAIL
		<input type="email" name="pro_email" id="pro_email" maxlength="200" size="2" value="<?php echo isset($mod->reg->PRO_EMAIL)? $mod->reg->PRO_EMAIL: '';?>">
		</div>

		<div class="input-field col s12 m12">
		CONTATO
		<input type="text" onkeypress="return apenasNumeros(event);" name="pro_contato" id="pro_contato" maxlength="9" value="<?php echo isset($mod->reg->PRO_CONTATO)? $mod->reg->PRO_CONTATO: '';?>">
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
		<input type="hidden" name="id" value="<?php echo isset($mod->reg->PRO_CODIGO)? $mod->reg->PRO_CODIGO: ''; ?>">
	</p>
	
</form>