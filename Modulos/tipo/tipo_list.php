<script>
	function verifica(){
		var busca = document.getElementById('f_busca').value;

		if( busca == ""){
			alert("Informe o que deve ser buscado");
			return false;
		}else{
			return true;
		}
	}
</script>

<div class="row">
<h4 class="col m12">CADASTRO DE TIPOS</h4>

<div class="col m12 s12">
	<a style="font-size: 20pt;" class="right" href="?menu=tipo&acao=incluir">Novo registro</a>
</div>

<form class="col s12 m12" name="frm_busca" id="frm_busca" method="get" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	<input class="col m12" type="text" name="f_busca" id="f_busca" maxlength="100" size="40" value=""
	style="height: 30px;" placeholder="Pesquisar...">
	<input class="btn" type="submit" value="BUSCAR" class="buscar">
	<input type="hidden" name="menu" value="<?php echo $menu;?>">
	<input type="hidden" name="acao" value="listar">
</form>

<div>
	<table class="bordered responsive-table col s12 m12">
		<thead>
			<tr>
				<th><a href="?menu=tipo&acao=listar&ord=1">Código</a></th>
				<th><a href="?menu=tipo&acao=listar&ord=2">Nome</a></th>
				<th>Ação</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
		while($reg = $mod->res->FetchNextObject()){
		?>
			<tr class="hoverable">
				<td><?php echo $reg->TIP_CODIGO ?></td>
				<td><?php echo $reg->TIP_NOME ?></td>
				<td><a href="?menu=tipo&acao=alterar&id=<?php echo $reg->TIP_CODIGO;?>">Alterar</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a style="color: #D50000; font-weight: bolder;" href="javascript:if(confirm('Confirma a exclusão deste registro?')){
				location='?menu=tipo&acao=excluir&id=<?php echo $reg->TIP_CODIGO?>';}">Excluir</a>
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