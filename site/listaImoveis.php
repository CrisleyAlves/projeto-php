<?php
	include("topoSite.php");
	include("formulario_pesquisa.php");
?>

<div class="lista">
	<div class="container-16">
		<ul>
			<?php 
			if($_GET['op'] == "Venda"){
				listaComprar();
			}else if($_GET['op'] == "Locação"){
				listaAlugar();
			}
			?>
		</ul>
	</div>
</div>

<?php
	include("footerSite.php");
?>