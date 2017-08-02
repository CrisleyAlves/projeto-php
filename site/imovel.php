<?php
	include("topoSite.php");
?>

<?php
	if(isset($_GET['cod']) && $_GET['cod'] != ""){
		infoImovel($_GET['cod']);
		pegaNomes($_GET['cod']);
	}else{
		header("Location: index.php");
	}
?>
<br>
<?php
	include("footerSite.php");
?>