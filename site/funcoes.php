<?php
	//conecta com banco PDO
	function conecta(){
		 try {
		    $pdo = new PDO("pgsql:host=localhost dbname=imobiliaria user=postgres password=postgres");
		 } catch (PDOException  $e) {
		    print $e->getMessage();
		 }
		 return $pdo;
	}

	function solicita($sol_nome, $sol_assunto, $cod_imovel, $sol_contato, $sol_email, $sol_mensagem){
		$pdo = conecta();
		$sol_status = "I";
		$sql = $pdo->prepare("INSERT INTO tbl_solicitacoes(sol_nome, sol_assunto, cod_imovel,sol_contato, sol_email, sol_mensagem, sol_status) VALUES(:sol_nome,:sol_assunto,:cod_imovel,:sol_contato,:sol_email,:sol_mensagem, :sol_status)");
		$sql->bindValue(":sol_nome","crisley");
		$sql->bindValue(":sol_assunto","asssunto");
		$sql->bindValue(":cod_imovel",2);
		$sql->bindValue(":sol_contato","12");
		$sql->bindValue(":sol_email","s@hotmail.com");
		$sql->bindValue(":sol_mensagem","mensagem");
		$sql->bindValue(":sol_status","I");
		$sql->Execute();
	}

	function listarImoveis(){
		$pdo = conecta();
		$sql = $pdo->prepare("SELECT * FROM tbl_imoveis imo, tbl_cidades cid, tbl_operacoes ope, tbl_bairros bai, tbl_tipos tip
			WHERE imo.tip_codigo = tip.tip_codigo AND imo.bai_codigo = bai.bai_codigo 
			AND imo.ope_codigo = ope.ope_codigo AND cid.cid_codigo = bai.cod_cidade");

		 $sql->execute();
		 while($res = $sql->fetch(PDO::FETCH_ASSOC)){
		 ?>
			<li>
				<a href="imovel.php?cod=<?php echo $res['imo_codigo'];?>">
				<div class="effect">
					<span class="effect-content">+infos</span>
				</div>
				<img src="img/apartament.jpg">
				<p class="tipo">Tipo: <?php echo $res['tip_nome'];?></p>
				<p class="quartos">Cidade: <?php echo $res['cid_nome'];?></p>
				<p class="quartos">Bairro: <?php echo $res['bai_nome'];?></p>
				<p class="quartos">Quartos: <?php echo $res['imo_quartos'];?></p>
				<p class="quartos">Operação: <?php echo $res['ope_nome'];?></p>
				<p class="condominio">Condominio: R$ <?php echo $res['imo_condominio'];?></p>
				<p class="valor">Valor: <?php echo $res['imo_valor'];?></p>
				</a>
			</li>

		 <?php
		 }
	}

	function listaAlugar(){
		$pdo = conecta();
			$sql = $pdo->prepare("SELECT * FROM tbl_imoveis imo, tbl_operacoes ope, tbl_bairros bai, tbl_tipos tip
				WHERE imo.tip_codigo = tip.tip_codigo AND imo.bai_codigo = bai.bai_codigo 
				AND imo.ope_codigo = ope.ope_codigo AND ope.ope_codigo = 3 ORDER BY imo.imo_valor");

			if($_GET['cidade'] != ""){
				$sql .= " AND cid.cid_nome = '".$_GET['cidade']."'";
			}

			 $sql->execute();
			 while($res = $sql->fetch(PDO::FETCH_ASSOC)){
			 ?>
				<li>
				<div class="effect">
					<a href="imovel.php?cod=<?php echo $res['imo_codigo']; ?>">fotos</a>
				</div>
				<img src="img/apartament.jpg" alt="">		
				<div id="infos">
					<p class="codigo">Código: <?php echo $res['imo_codigo'];?></p>
					<p class="tipo">Tipo: <?php echo $res['tip_nome'];?></p>
					<p class="tipo">Quartos: <?php echo $res['imo_quartos'];?></p>
					<p class="bairro">Bairro: <?php echo $res['bai_nome'] ?></p>
				</div>
				<div id="valor">
					<p class="valor">R$ <?php echo $res['imo_valor']; ?></p>
					<a href="imovel.php?cod=<?php echo $res['imo_codigo']; ?>">+infos</a>
				</div>
			</li>

			 <?php
			 }
	}		

	function listaComprar(){
		$pdo = conecta();
			$sql = $pdo->prepare("SELECT * FROM tbl_imoveis imo, tbl_operacoes ope, tbl_bairros bai, tbl_tipos tip
				WHERE imo.tip_codigo = tip.tip_codigo AND imo.bai_codigo = bai.bai_codigo 
				AND imo.ope_codigo = ope.ope_codigo AND ope.ope_codigo = 2");
			//2 = compra
			 $sql->execute();
			 while($res = $sql->fetch(PDO::FETCH_ASSOC)){
			 ?>
			<li>
			<div class="effect">
				<a href="imovel.php?cod=<?php echo $res['imo_codigo']; ?>">fotos</a>
			</div>
				<img src="img/apartament.jpg" alt="">		
			<div id="infos">
				<p class="codigo">Código: <?php echo $res['imo_codigo'];?></p>
				<p class="tipo">Tipo: <?php echo $res['tip_nome'];?></p>
				<p class="tipo">Quartos: <?php echo $res['imo_quartos'];?></p>
				<p class="bairro">Bairro: <?php echo $res['bai_nome'] ?></p>
			</div>
			<div id="valor">
				<p class="valor">R$ <?php echo $res['imo_valor']; ?></p>
				<a href="imovel.php?cod=<?php echo $res['imo_codigo']; ?>">+infos</a>
			</div>
		</li>
		 <?php
		 }
	}		


	function infoImovel($imo_codigo){
	$pdo = conecta();
	$sql = $pdo->prepare("SELECT * FROM tbl_imoveis WHERE imo_codigo = ?");
	$sql->bindValue(1,$imo_codigo);
	$sql->execute();
	while($res = $sql->fetch(PDO::FETCH_ASSOC)){
		if($res['imo_codigo'] == $imo_codigo){
	?>
	<div class="edificio">
		<div class="topo">
			<div class="container-16">
				<h3> <?php echo $res['imo_descricao']; ?></h3>
				<h3 style="margin-left: 25%;color: #000000;font-size: 14pt;margin-top: 20px;">codigo: <?php echo $res['imo_codigo']; ?></h3>
				<p class="valor">Valor: <span>R$ <?php echo $res['imo_valor']; ?></span></p>
			</div>
		</div>
	</div>
	<?php
		}//FECHA O IF
	} // FECHA O LAÇO WHILE
	?>

	<div id="pagination">
		
	</div>
	<?php

	} // FECHA A FUNÇÃO

	function pegaNomes($imo_codigo){
		$nomeFotos = array();
		$pdo = conecta();
		$sql = $pdo->prepare("SELECT * FROM tbl_fotos imo WHERE imo.imo_codigo = ?");
		$sql->bindValue(1,$imo_codigo);
		$sql->Execute();
		while($res = $sql->fetch(PDO::FETCH_ASSOC)){
			if($res['imo_codigo'] == $imo_codigo){	
				$temp = $res['fot_nome']; // pega o nome do arquivo no banco
				$ext_arquivo = strrchr($temp, '.'); // pega extensão do arquivo
				$temp = str_replace(".jpg", "", $temp); // retira a extensão do arquivo do nome do arquivo
				array_push($nomeFotos, $temp); // insere somente o nome em um array
			}
		}
		mostraImagens($nomeFotos);
	}

	function mostraImagens($nomeFotos){
		?>

		<div class="container-16">
		<div id="slider">
		<?php
		foreach ($nomeFotos as $dado) {
		?>
			<img src="../img/<?php echo $dado?>.jpg" class="responsive-img materialboxed" alt="" style="width: 100%; height: 500px;">
		<?php
		}
		?>
		</div>
		</div>
		<?php
	}

	function listaCidades(){
		$pdo = conecta();
		$sql = $pdo->prepare("SELECT * FROM tbl_cidades");
		$sql->Execute();
		$retorno = "";
		while($res = $sql->fetch(PDO::FETCH_ASSOC)){
			$retorno .= "<option>".$res['cid_nome']."</option>";
		}
		return $retorno;
	}

	function listaOperacoes(){
		$pdo = conecta();
		$sql = $pdo->prepare("SELECT * FROM tbl_operacoes");
		$sql->Execute();
		$retorno = "";
		while($res = $sql->fetch(PDO::FETCH_ASSOC)){
			$retorno .= "<option>".$res['ope_nome']."</option>";
		}
		return $retorno;
	}

	function listaBairros(){
		$pdo = conecta();
		$sql = $pdo->prepare("SELECT * FROM tbl_bairros");
		$sql->Execute();
		$retorno = "";
		while($res = $sql->fetch(PDO::FETCH_ASSOC)){
			$retorno .= "<option>".$res['bai_nome']."</option>";
		}
		return $retorno;

		pg_fetch_assoc($sql);
	}

	function listaTipos(){
		$pdo = conecta();
		$sql = $pdo->prepare("SELECT * FROM tbl_tipos");
		$sql->Execute();
		$retorno = "";
		while($res = $sql->fetch(PDO::FETCH_ASSOC)){
			$retorno .= "<option>".$res['tip_nome']."</option>";
		}
		return $retorno;
	}
?>