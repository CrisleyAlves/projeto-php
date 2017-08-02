<?php
	require('../../config.php');
	require('../../biblioteca/adodb/adodb.inc.php'); // arquivo de inicialização da adodb.
	require('../../conecta.php'); // arquivo que inicia a conecta com o banco.
	require('../../funcoes.php');

	require("../../biblioteca/fpdf/fpdf.php");
	define("FPDF_FONTPATH", "../../biblioteca/fpdf/font/");
	$pdf = new FPDF();
	$pdf->AddPage('P',"A4");

	$pdf->SetFont('Arial','B',14);
	$pdf->SetFillColor(000,000,000);
	$pdf->SetTextColor(255,255,255);

	//190 é o tamanho máximo da página, tipo um width = 100%;
	$pdf->Cell(190,10,"RELATORIO DOS BAIRROS",1,1,"C",1);

	$pdf->SetTextColor(000,000,000);
	$pdf->Ln(5); // da um espaço entre o que estiver a cima e o próximo conteúdo
	$pdf->CELL(30,10,"CODIGO",1,0,"C",0);
	$pdf->CELL(120,10,"NOME",1,0,"C",0);
	$pdf->CELL(40,10,"CIDADE",1,1,"C",0);
	$pdf->SetFont('Arial','',10);

	$mod = new conecta();
	$sql = "SELECT * FROM tbl_cidades cid, tbl_bairros bai 
	WHERE bai.cod_cidade= cid.cid_codigo ORDER BY cid.cid_nome";

	$res = $mod->bd->Execute($sql);
	$linhas = 0;
	while($reg = $res->FetchNextObject()){
		$pdf->CELL(30,10,$reg->BAI_CODIGO,1,0,"C",0);
		$pdf->CELL(120,10,utf8_decode($reg->BAI_NOME),1,0,"C",0);
		$pdf->CELL(40,10,utf8_decode($reg->CID_NOME),1,1,"C",0);
		$linhas++;
	}
	$pdf->Ln(3);
	$pdf->CELL(100,5,"TOTAL DE REGISTROS LISTADOS: ".$linhas,0,0,"L",0);
	$pdf->CELL(90,5,"Data-Hora: ".date("d/m/Y-H:i:s"),0,1,"R",0);
	$pdf->Output("relatorio-bairros.pdf");
	redireciona("http://localhost/trabalho-adilso/Projeto/Projeto/modulos/bairro/relatorio-bairros.pdf");
?>