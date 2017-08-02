<?php
	require('../../config.php');
	require('../../biblioteca/adodb/adodb.inc.php'); // arquivo de inicialização da adodb.
	require('../../conecta.php'); // arquivo que inicia a conecta com o banco.
	require('../../funcoes.php');

	require("../../biblioteca/fpdf/fpdf.php");
	define("FPDF_FONTPATH", "../../biblioteca/fpdf/font/");
	$pdf = new FPDF();
	$pdf->AddPage('L',"A4");

	$pdf->SetFont('Arial','B',11);
	$pdf->SetFillColor(000,000,000);
	$pdf->SetTextColor(255,255,255);

	//190 é o tamanho máximo da página, tipo um width = 100%;
	$pdf->Cell(277,10,"RELATORIO DOS IMOVEIS",1,1,"C",1);

	$pdf->SetTextColor(000,000,000);
	$pdf->Ln(5); // da um espaço entre o que estiver a cima e o próximo conteúdo
	$pdf->CELL(15,10,"COD",1,0,"C",0);
	$pdf->CELL(80,10,"ENDERECO",1,0,"C",0);
	$pdf->CELL(27,10,"QUARTOS",1,0,"C",0);
	$pdf->CELL(27,10,"VALOR",1,0,"C",0);
	$pdf->CELL(27,10,"CONDOMINIO",1,0,"C",0);
	$pdf->CELL(27,10,"TIPO",1,0,"C",0);
	$pdf->CELL(27,10,"OPERACAO",1,0,"C",0);
	$pdf->CELL(45,10,"PROPRIETARIO",1,1,"C",0);
	$pdf->SetFont('Arial','',10);

	$mod = new conecta();
	$sql = "SELECT * FROM tbl_imoveis imo, tbl_bairros bai, tbl_proprietarios pro, tbl_operacoes ope, tbl_tipos tip WHERE	imo.PRO_CODIGO = pro.PRO_CODIGO AND imo.TIP_CODIGO = tip.TIP_CODIGO AND ope.ope_codigo = imo.ope_codigo AND imo.bai_codigo = bai.bai_codigo";

	$res = $mod->bd->Execute($sql);
	$linhas = 0;
	while($reg = $res->FetchNextObject()){
		$pdf->CELL(15,10,$reg->IMO_CODIGO,1,0,"C",0);
		$pdf->CELL(80,10,utf8_decode($reg->IMO_ENDERECO),1,0,"C",0);
		$pdf->CELL(27,10,$reg->IMO_QUARTOS,1,0,"C",0);
		$pdf->CELL(27,10,$reg->IMO_VALOR,1,0,"C",0);
		$pdf->CELL(27,10,$reg->IMO_CONDOMINIO,1,0,"C",0);
		$pdf->CELL(27,10,$reg->TIP_NOME,1,0,"C",0);
		$pdf->CELL(27,10,utf8_decode($reg->OPE_NOME),1,0,"C",0);
		$pdf->CELL(45,10,utf8_decode($reg->PRO_NOME),1,1,"C",0);
		$linhas++;
	}

	$pdf->Ln(3);
	$pdf->CELL(100,5,"TOTAL DE REGISTROS LISTADOS: ".$linhas,0,0,"L",0);
	$pdf->CELL(90,5,"Data-Hora: ".date("d/m/Y-H:i:s"),0,1,"R",0);
	$pdf->Output("relatorio-imoveis.pdf");
	redireciona("http://localhost/trabalho-adilso/Projeto/Projeto/modulos/imovel/relatorio-imoveis.pdf");
?>