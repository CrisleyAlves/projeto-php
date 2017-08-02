<script>
	function verifica(){
		var busca = document.getElementById('f_busca').value;

		if(busca== ""){
			alert("Informe o que deve ser buscado");
			document.getElementById('f_busca').focus();
			return false;
		}else{
			return true;
		}
	}
</script>

<div class="row">
<h4 class="col m12">CADASTRO DE IMÓVEIS</h4>

<div class="col m12 s12">
	<a style="font-size: 20pt;" class="right" href="?menu=imovel&acao=incluir">Novo registro</a>
</div>

<form class="col s12 m12" name="frm_busca" id="frm_busca" method="get" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	<input class="col m9 s12" type="text" name="f_busca" id="f_busca" maxlength="100" value=""
	placeholder="Pesquisar...">
	
	<select name="op" id="op" class="col m3 s12">
		<option value="codigo">codigo</option>
		<option value="endereco">endereco</option>
		<option value="bairro">bairro</option>
		<option value="operacao">operacao</option>
		<option value="tipo">tipo</option>
		<option value="proprietario">proprietario</option>
	</select>

	<input class="btn" type="submit" value="BUSCAR" class="buscar">
	<input type="hidden" name="menu" value="<?php echo $menu;?>">
	<input type="hidden" name="acao" value="listar">
</form>

<table class="bordered responsive-table col s12 m12">
		<tr>
			<thead>
				<th><a href="?menu=imovel&acao=listar&ord=1">Código</a></th>
				<th><a href="?menu=imovel&acao=listar&ord=2">Endereço</a></th>
				<th><a href="?menu=imovel&acao=listar&ord=3">Descrição</a></th>
				<th><a href="?menu=imovel&acao=listar&ord=4">Bairro</a></th>
				<th><a href="?menu=imovel&acao=listar&ord=5">Operação</a></th>
				<th><a href="?menu=imovel&acao=listar&ord=6">Valor</a></th>
				<th>Proprietario</th>
				<th><a href="?menu=imovel&acao=listar&ord=7">Tipo</a></th>
				<th>Ação</th>
			</thead>
		</tr>

		<?php
		while($reg = $mod->res->FetchNextObject()){
		?>
			<tr class="hoverable">
				<td><?php echo $reg->IMO_CODIGO ?></td>
				<td><?php echo $reg->IMO_ENDERECO?></td>
				<td><?php echo $reg->IMO_DESCRICAO ?></td>
				<td><?php echo $reg->BAI_NOME ?></td>
				<td><?php echo $reg->OPE_NOME ?></td>
				<td><?php echo $reg->IMO_VALOR ?></td>
				<td><?php echo $reg->PRO_NOME ?></td>
				<td><?php echo $reg->TIP_NOME ?></td>
				<td><a href="?menu=imovel&acao=alterar&id=<?php echo $reg->IMO_CODIGO;?>">Alterar</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a style="color: #D50000; font-weight: bolder;" href="javascript:if(confirm('Confirma a exclusão deste registro?')){
				location='?menu=imovel&acao=excluir&id=<?php echo $reg->IMO_CODIGO?>';}">Excluir</a>
				</td>
			</tr>
		<?php
		}?>
	</table>
	<div class="col s12 m12">
				<?php echo "Total de registros: ".$mod->total()." "?>
				<?php echo " Paginas: ".$mod->paginacao(); ?>
	</div>
</div>