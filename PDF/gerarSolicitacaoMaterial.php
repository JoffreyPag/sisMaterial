<?php
require('cellfit.php');
require_once("../Api/fpdf/fpdf.php");
include_once("../conexao.php");

//$pdf = new FPDF("p", "pt", "A4");
$pdf = new FPDF_CellFit("p", "pt", "A4");
//$idconsumos = $_POST['consumos'];
//$id_req = $_POST['id'];

//$sql = "SELECT";
//$result = $conn->query($sql);
//$row = mysqli_fetch_array($result);

$pdf->AddPage();
$pdf->Image('logo.png',450,33,-200);
$pdf->SetFont('arial', 'B', 14);
//$pdf->Ln(40);
$pdf->Cell(540,60,"REQUISIÇÃO INTERNA DE MATERIAL",1,1,'C');
$pdf->SetFont('arial', 'B', 12);
$pdf->CellFitScale(125,20,"Unidade Requisitante",1,0,'L');
$pdf->SetFont('arial', '');
$pdf->CellFitScale(275,20,"unidade que esta requisitando aqui =]",1,0,'L');
$pdf->SetFont('arial', 'B');
$pdf->Cell(35,20,"Data",1,0,'L');
$pdf->SetFont('arial', '');
$pdf->Cell(105,20,"dd/mm/AAAA",1,1,'L');
$pdf->Cell(75,20,"Nº de ordem",1,0,'L');
$pdf->Cell(360, 20, "MATERIAL", 1, 0, 'C');
$pdf->Cell(105, 20, "Quantidade", 1,1, 'C');
//$pdf->Cell(75);
//varias coisas loocas aqui!

//$pdf->Cell();

$pdf->Output("arquivo.pdf","I");
?>