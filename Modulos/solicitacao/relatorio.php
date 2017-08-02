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
	$pdf->Cell(277,10,"RELATORIO DAS SOLICITACOES",1,1,"C",1);

	$pdf->SetTextColor(000,000,000);
	$pdf->Ln(5); // da um espaço entre o que estiver a cima e o próximo conteúdo
	$pdf->CELL(15,10,"COD",1,0,"C",0);
	$pdf->CELL(70,10,"NOME",1,0,"C",0);
	$pdf->CELL(33,10,"ASSUNTO",1,0,"C",0);
	$pdf->CELL(27,10,"IMOVEL",1,0,"C",0);
	$pdf->CELL(27,10,"CONTATO",1,0,"C",0);
	$pdf->CELL(60,10,"EMAIL",1,0,"C",0);
	$pdf->CELL(45,10,"STATUS",1,1,"C",0);
	$pdf->SetFont('Arial','',10);

	$mod = new conecta();
	$sql = "SELECT * FROM tbl_solicitacoes sol, tbl_imoveis imo
	WHERE sol.sol_imovel = imo.imo_codigo";

	$res = $mod->bd->Execute($sql);
	$linhas = 0;
	while($reg = $res->FetchNextObject()){
		$pdf->CELL(15,10,$reg->SOL_CODIGO,1,0,"C",0);
		$pdf->CELL(70,10,utf8_decode($reg->SOL_NOME),1,0,"C",0);
		$pdf->CELL(33,10,$reg->SOL_ASSUNTO,1,0,"C",0);
		$pdf->CELL(27,10,$reg->IMO_CODIGO,1,0,"C",0);
		$pdf->CELL(27,10,$reg->SOL_CONTATO,1,0,"C",0);
		$pdf->CELL(60,10,$reg->SOL_EMAIL,1,0,"C",0);
		$pdf->CELL(45,10,utf8_decode($reg->SOL_STATUS),1,1,"C",0);
		$linhas++;
	}

	$pdf->Ln(3);
	$pdf->CELL(100,5,"TOTAL DE REGISTROS LISTADOS: ".$linhas,0,0,"L",0);
	$pdf->CELL(90,5,"Data-Hora: ".date("d/m/Y-H:i:s"),0,1,"R",0);
	$pdf->Output("relatorio-solicitacoes.pdf");
	redireciona("http://localhost/trabalho-adilso/Projeto/Projeto/modulos/solicitacao/relatorio-solicitacoes.pdf");
?>