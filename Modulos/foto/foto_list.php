<div class="row">
<h4 class="col m12">CADASTRO DE FOTOS</h4>

<div class="col m12 s12">
	<a style="font-size: 20pt;" class="right" href="?menu=foto&acao=incluir">Novo registro</a>
</div>

<form class="col s12 m12" name="frm_busca" id="frm_busca" method="get" action="index.php" enctype="multipart/form-data">
	<input class="col m12" type="text" name="f_busca" id="f_busca" maxlength="100" size="40" value=""placeholder="Pesquisar...">
	<input class="btn" type="submit" value="BUSCAR" class="buscar">
	<input type="hidden" name="menu" value="<?php echo $menu;?>">
	<input type="hidden" name="acao" value="listar">
</form>

<div>
	<table class="bordered responsive-table col s12 m12">
		<thead>
			<tr>
				<th><a href="?menu=foto&acao=listar&ord=1">Código</a></th>
				<th><a href="?menu=foto&acao=listar&ord=2">Imóvel</a></th>
				<th><a href="?menu=foto&acao=listar&ord=2">Imagem</a></th>
				<th>Ação</th>
			</tr>
		</thead>
		
		<tbody>
		<?php
		while($reg = $mod->res->FetchNextObject()){
		?>
			<tr class="hoverable">
				<td><?php echo $reg->FOT_CODIGO ?></td>
				<td><?php echo $reg->IMO_CODIGO." - ".$reg->IMO_DESCRICAO ?></td>
				<td><img style="width: 200px; height: 200px;" src="img/<?php echo $reg->FOT_NOME ?>" title="<?php echo $reg->FOT_NOME ?>"></td>
				<td><a href="?menu=foto&acao=alterar&id=<?php echo $reg->FOT_CODIGO;?>&nomeImagem=<?php echo $reg->FOT_NOME?>;">Alterar</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a style="color: #D50000; font-weight: bolder;" href="javascript:if(confirm('Confirma a exclusão deste registro?')){
				location='?menu=foto&acao=excluir&id=<?php echo $reg->FOT_CODIGO?>&nomeImagem=<?php echo $reg->FOT_NOME?>';}">Excluir</a>
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