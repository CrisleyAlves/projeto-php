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
<h4 class="col m12">CADASTRO DE PROPRIETARIOS</h4>

<div class="col m12 s12">
	<a style="font-size: 20pt;" class="right" href="?menu=proprietario&acao=incluir">Novo registro</a>
</div>

<form class="col s12 m12" name="frm_busca" id="frm_busca" method="get" action="index.php" enctype="multipart/form-data" onsubmit="return verifica();">
	<input class="col m9" type="text" name="f_busca" id="f_busca" maxlength="100" placeholder="Pesquisar...">
	<select name="op" id="op" class="col s12 m3">
		<option value="nome">nome</option>
		<option value="cpf">cpf</option>
		<option value="rg">rg</option>
	</select>
	<input class="btn col m4 s12" type="submit" value="BUSCAR" class="buscar">
	<input type="hidden" name="menu" value="<?php echo $menu;?>">
	<input type="hidden" name="acao" value="listar">
</form>



<div class="clear"></div>
<div>
	<table class="bordered responsive-table col s12 m12">
		<tr>
			<th><a href="?menu=proprietario&acao=listar&ord=1">Código</a></th>
			<th><a href="?menu=proprietario&acao=listar&ord=2">Nome</a></th>
			<th><a href="?menu=proprietario&acao=listar&ord=3">Email</a></th>
			<th><a >Cpf</a></th>
			<th><a >Rg</a></th>
			<th><a href="?menu=proprietario&acao=listar&ord=4">Contato</a></th>
			<th>Ação</th>
		</tr>

		<?php
		while($reg = $mod->res->FetchNextObject()){
		?>
			<tr class="hoverable">
				<td><?php echo $reg->PRO_CODIGO ?></td>
				<td><?php echo $reg->PRO_NOME ?></td>
				<td><?php echo $reg->PRO_EMAIL ?></td>
				<td><?php echo $reg->PRO_CPF ?></td>
				<td><?php echo $reg->PRO_RG ?></td>

				<td><?php echo $reg->PRO_CONTATO ?></td>
				<td><a href="?menu=proprietario&acao=alterar&id=<?php echo $reg->PRO_CODIGO;?>">Alterar</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a style="color: #D50000; font-weight: bolder;" href="javascript:if(confirm('Confirma a exclusão deste registro?')){
				location='?menu=proprietario&acao=excluir&id=<?php echo $reg->PRO_CODIGO?>';}">Excluir</a>
				</td>
			</tr>
		<?php
		}
		?>
	</table>
	<div class="col s12 m12">
		<?php echo "Total de registros: ".$mod->total()." "?>
		<?php echo " Paginas: ".$mod->paginacao(); ?>
	</div>
</div>