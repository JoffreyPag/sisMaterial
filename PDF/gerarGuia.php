<?php
require_once("../Api/fpdf/fpdf.php");

$pdf = new FPDF("p", "pt", "A4");

$pdf->AddPage();
$pdf->Image('logo.png',450,10,-200);
$pdf->SetFont('arial', 'B', 14);
$pdf->Ln(30);
$pdf->Cell(0,20,"GUIA DE TRÂNSITO DE MATERIAIS",0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('arial', '', 12);
$pdf->Cell(0,20, "Autorizo o encaminhamento, a utilização e o trânsito dos bens abaixo relacionados:",0,1,'C');
$pdf->Ln(10);

//tabela 
$pdf->SetFont('arial','B');
$pdf->Cell(100,20,'SETOR/ORIGEM',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->Cell(400,20,'Coordenação do e-Tec - Escola Agrícola de Jundiaí/UFRN',1,1,"L");
$pdf->SetFont('arial','B');
$pdf->Cell(100,20,'RESPONSÁVEL',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->Cell(400,20,'xXXXXXXXXXXXXXX',1,1,"L");
$pdf->SetFont('arial','B');
$pdf->Cell(100,20,'SETOR/DESTINO',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->Cell(400,20,'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy',1,1,"L");
$pdf->SetFont('arial','B');
$pdf->Cell(100,20,'JUSTIFICATIVA',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->Cell(400,20,'JJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJJ',1,1,"L");
$pdf->Cell(500,20,'',1,1,"L");
$pdf->SetFont('arial','B');
$pdf->Cell(166.66,20,'Nº Patrimônio',1,0,"L");
$pdf->Cell(166.66,20,'Especificação',1,0,"L");
$pdf->Cell(166.66,20,'Acessórios',1,1,"L");

$pdf->SetFont('arial', '');
//DADOS AQUI

$pdf->Ln(20);
$pdf->Cell(100,20,'Entregue por:',0,0,'L');
$pdf->SetFont('arial', 'U');
$pdf->Cell(500,20,'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',0,1,'L');
$pdf->Ln(10);
$pdf->SetFont('arial', '');
$pdf->Cell(100,20,'Recebido por:',0,0,'L');
$pdf->SetFont('arial', 'U');
$pdf->Cell(500,20,'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',0,1,'L');
$pdf->SetFont('arial', '');
$pdf->Ln(20);
$pdf->Cell(100,20,'Autorizado por:',0,0,'L');
$pdf->SetFont('arial', 'U');
$pdf->Cell(400,20,'MAX',0,1,'L');
$pdf->SetFont('arial', '', 10);
$pdf->Cell(300,20,'(Coordenador Geral do e-Tec/EAJ)',0,1,'C');
$pdf->Ln(20);
$pdf->SetFont('arial', '', 12);
$pdf->Cell(30,20,'Em:',0,0,'L');
$pdf->Cell(30,20,'dd',0,0,'L');
$pdf->Cell(30,20,'de',0,0,'L');
$pdf->Cell(30,20,'mm',0,0,'L');
$pdf->Cell(30,20,'de',0,0,'L');
$pdf->Cell(30,20,'AAAA',0,0,'L');

$pdf->Output("arquivo.pdf","I");

?>