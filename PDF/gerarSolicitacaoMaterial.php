<?php
require('cellfit.php');
require_once("../Api/fpdf/fpdf.php");
include_once("../conexao.php");

//$pdf = new FPDF("p", "pt", "A4");
$pdf = new FPDF_CellFit("p", "pt", "A4");

$idconsumos = $_POST['consumos']; //tabela consumos da requisicao
$id_req = $_POST['id']; //tabela requisicao

$sqlids = "SELECT * FROM tabela_consumos WHERE id_consumos = $idconsumos";
$resultids = $conn->query($sqlids);
$rowids = mysqli_fetch_array($resultids);

$sql = "SELECT erc.solicitante, erc.autorizado, erc.receptor, erc.dia, erc.mes, erc.ano, erc.stats, dp.nome, po.municipio, po.cidade FROM etec_requisicao_consumo erc 
        INNER JOIN etec_departamento dp ON dp.id_departamento = erc.id_destino 
        INNER JOIN etec_polo po ON po.idpolo = dp.idpolo 
        WHERE erc.id_requisicao = $id_req";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$pdf->AddPage();
$pdf->Image('logo.png',450,33,-200);
$pdf->SetFont('arial', 'B', 14);
//$pdf->Ln(40);
$pdf->Cell(540,60,"REQUISIÇÃO INTERNA DE MATERIAL",1,1,'C');
$pdf->SetFont('arial', 'B', 12);
$pdf->CellFitScale(125,20,"Unidade Requisitante",1,0,'L');
$pdf->SetFont('arial', '');
//$pdf->CellFitScale(275,20,'AAAAAAAAAAAAA',1,0,'L');
$pdf->CellFitScale(275,20,''.$row['municipio'].'/'.$row['cidade'].'-'.$row['nome'].'',1,0,'L');
$pdf->SetFont('arial', 'B');
$pdf->Cell(35,20,"Data",1,0,'L');
$pdf->SetFont('arial', '');
//$pdf->Cell(105,20,'bbbbbbbbb',1,1,'L');
$pdf->Cell(105,20,''.$row['dia'].'/'.$row['mes'].'/'.$row['ano'].'',1,1,'L');
$pdf->Cell(75,40,"Nº de ordem",1,0,'L');
$pdf->Cell(465, 20, "MATERIAL", 1, 1, 'C');
$pdf->Cell(75,20,"",0,0,'C');
$pdf->Cell(315,20,"Descrição",1,0,'C');
$pdf->Cell(75,20,"Unidade",1,0,'C');
$pdf->Cell(75,20,"Quantidade",1,1,'C');
//varias coisas loocas aqui!
//DADOS AQUI
$aux = 1;
for($i=1; $i<=40; $i+=2){
    if($rowids[$i] != null){
        $sqlzinho = "SELECT especificacao, unidade FROM etec_materiais_consumo WHERE id_consumo = ".$rowids[$i];
        $r = $conn->query($sqlzinho);
        $rowmat = mysqli_fetch_array($r);
        $pdf->Cell(75,20,$aux,1,0,'C');
        $aux++;
        $pdf->CellFitScale(315,20,"".$rowmat['especificacao'],1,0,'L');
        $pdf->Cell(75,20,"".$rowmat['unidade'],1,0,'C');
        $pdf->Cell(75,20,"".$rowids[$i+1],1,1,'C');
    }
}
$pdf->Ln(20);
$pdf->Cell(180, 20, "Solicitado por:",0,0,'L');
$pdf->Cell(180, 20, "Autorizado por:",0,0,'L');
$pdf->Cell(180, 20, "recebido por:",0,1,'L');
$pdf->Cell(180, 30, "".$row['solicitante'],1,0,'C');
$pdf->Cell(180, 30, "".$row['autorizado'],1,0,'C');
$pdf->Cell(180, 30, "".$row['receptor'],1,1,'C');
$pdf->Output("arquivo.pdf","I");
?>