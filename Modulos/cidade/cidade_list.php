<script>
	function verifica(){
		var busca = document.getElementById('f_busca').value;

		if( busca == ""){
			alert("Informe o que deve ser buscado");
			document.getElementById('f_busca').focus();
			return false;
		}else{
			return true;
		}
	}
</script>

<div class="row">
<h4 class="col m12">CADASTRO DE CIDADES</h4>

<div class="col m12 s12">
	<a style="font-size: 20pt;" class="right" href="?menu=cidade&acao=incluir">Novo registro</a>
</div>

<form class="col s12 m12" name="frm_busca" id="frm_busca" method="get" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	<input class="col m9" type="text" name="f_busca" id="f_busca" maxlength="100" size="40" value="" placeholder="Pesquisar...">
	<select name="op" id="op" class="col m3 s12">
		<option value="cidade">cidade</option>
		<option value="uf">uf</option>
	</select>
	<input class="btn" type="submit" value="BUSCAR" class="buscar">
	<input type="hidden" name="menu" value="<?php echo $menu;?>">
	<input type="hidden" name="acao" value="listar">
</form>

<div class="clear"></div>
<div>
	<table class="bordered responsive-table col s12 m12">
		<thead>
			<tr>
				<th><a href="?menu=cidade&acao=listar&ord=1">Código</a></th>
				<th><a href="?menu=cidade&acao=listar&ord=2">Cidade</a></th>
				<th><a href="?menu=cidade&acao=listar&ord=3">UF</a></th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while($reg = $mod->res->FetchNextObject()){
		?>
			<tr class="hoverable">
				<td><?php echo $reg->CID_CODIGO ?></td>
				<td><?php echo $reg->CID_NOME ?></td>
				<td><?php echo $reg->CID_UF ?></td>
				<td><a href="?menu=cidade&acao=alterar&id=<?php echo $reg->CID_CODIGO;?>">Alterar</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a style="color: #D50000; font-weight: bolder;" href="javascript:if(confirm('Confirma a exclusão deste registro?')){
				location='?menu=cidade&acao=excluir&id=<?php echo $reg->CID_CODIGO?>';}">Excluir</a>
				</td>
			</tr>
			<?php
			}?>
			</tbody>
	</table>
	<div class="col s12 m12">
		<?php echo "Total de registros: ".$mod->total()." "?>
		<?php echo " Paginas: ".$mod->paginacao(); ?>
	</div>
</div>
</div>