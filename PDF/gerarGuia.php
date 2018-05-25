<?php
require('cellfit.php');
require_once("../Api/fpdf/fpdf.php");
include_once("../conexao.php");
$idguia = $_POST['idguia'];
$idtombos = $_POST['tombos'];
$sql = "SELECT dp.nome, do.nome, po.municipio, po.cidade, pl.municipio, pl.cidade, g.responsavel, 
                g.justificativa, g.entregador, g.destinatario, g.autorizador, g.dia, g.mes, g.ano 
        FROM etec_guias_lab g 
        INNER JOIN etec_departamento dp ON g.id_origem = dp.id_departamento 
        INNER JOIN etec_departamento do ON g.id_destino = do.id_departamento 
        INNER JOIN etec_polo po ON dp.idpolo = po.idpolo 
        INNER JOIN etec_polo pl ON do.idpolo = pl.idpolo 
        WHERE g.id_guia = $idguia";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$sqlTombos = "SELECT * FROM numero_tombos WHERE id_tombos = $idtombos";
$resultombos = $conn->query($sqlTombos);
$rowtombos = mysqli_fetch_array($resultombos);

//$pdf = new FPDF("p", "pt", "A4");
$pdf = new FPDF_CellFit("p", "pt", "A4");

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
$pdf->Cell(125,20,'SETOR/ORIGEM',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->CellFitScale(375,20,'Coordenação do e-Tec - Escola Agrícola de Jundiaí/UFRN',1,1,"L");
//$pdf->CellFitScale(375,20,''.$row[2].'/'.$row[3].' - '.$row[0],1,1,"L");//SUBSTITUI PELO DE CIMA
$pdf->SetFont('arial','B');
$pdf->Cell(125,20,'RESPONSÁVEL',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->Cell(375,20,''.$row['responsavel'],1,1,"L");
$pdf->SetFont('arial','B');
$pdf->Cell(125,20,'SETOR/DESTINO',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->CellFitScale(375,20,''.$row[4].'/'.$row[5].' - '.$row[1],1,1,"L");
$pdf->SetFont('arial','B');
$pdf->Cell(125,20,'JUSTIFICATIVA',1,0,"L");
$pdf->SetFont('arial', '');
$pdf->Cell(375,20,''.$row['justificativa'],1,1,"L");
$pdf->Cell(500,20,'',1,1,"L");
$pdf->SetFont('arial','B');
$pdf->Cell(166.66,20,'Nº Patrimônio',1,0,"L");
$pdf->Cell(166.66,20,'Especificação',1,0,"L");
$pdf->Cell(166.66,20,'Acessórios',1,1,"L");

$pdf->SetFont('arial', '');
//DADOS AQUI
for($i=1; $i<=20; $i++){
    if($rowtombos[$i] != null){
        $sqlzinho = "SELECT m.especificacao, m.acessorio FROM etec_tombo t 
        INNER JOIN etec_materiais_permanentes m ON m.id_permanente = t.id_material 
        WHERE t.numero_tombo = ".$rowtombos[$i];
        $r = $conn->query($sqlzinho);
        $rowmat = mysqli_fetch_array($r);
        $pdf->Cell(166.66,40,''.$rowtombos[$i],1,0,'L');
        $pdf->CellFitScale(166.66,40,''.$rowmat['especificacao'],1,0,'L');
        $pdf->CellFitScale(166.66,40,''.$rowmat['acessorio'],1,1,'L');

        /*PARA UM FUTURO NAO PROXIMO, SE FOR PRECISO AUMENTAR O TAMANHO DAS CELULAS
        POR MOTIVOS DE ALGUM CAMPO SER GRANDE DE MAIS, VAI SER MELHOR USAR O MULTICELL
        EU PARTICULARMENTE NAO TIVE SACO DE AJEITAR OS BUGS DESSA API, RECOMENDO QUE VOCE
        PROCURE UMA API MAIS AMOR DO QUE CONTINUAR COM ESSA, MAS SE NAO FOR PRECISO TROCAR
        ENTAO TÁ ÓTIMO :]*/
       //$y = $pdf->GetY();
       //$x = $pdf->GetX();
       //$width = 166.66;
       //$pdf->Cell($width,40,''.$rowtombos[$i],1,0,'J');
       //$pdf->SetXY($x + $width, $y);
       //$pdf->MultiCell($width,20,''.$rowmat['especificacao'],1, 'J', false);
       //$pdf->SetXY($x + $width*2, $y);
       //$pdf->MultiCell($width,20,''.$rowmat['acessorio'],1,'J',false);
    }else{
        break;
    }
}


$pdf->Ln(20);
$pdf->Cell(100,20,'Entregue por:',0,0,'L');
$pdf->SetFont('arial', 'U');
$pdf->Cell(500,20,''.$row['entregador'],0,1,'L');
$pdf->Ln(10);
$pdf->SetFont('arial', '');
$pdf->Cell(100,20,'Recebido por:',0,0,'L');
$pdf->SetFont('arial', 'U');
$pdf->Cell(500,20,''.$row['destinatario'],0,1,'L');
$pdf->SetFont('arial', '');
$pdf->Ln(20);
$pdf->Cell(100,20,'Autorizado por:',0,0,'L');
$pdf->SetFont('arial', 'U');
$pdf->Cell(400,20,''.$row['autorizador'],0,1,'L');
$pdf->SetFont('arial', '', 10);
$pdf->Cell(300,20,'(Coordenador Geral do e-Tec/EAJ)',0,1,'C');
$pdf->Ln(20);
$pdf->SetFont('arial', '', 12);
$pdf->Cell(30,20,'Em:',0,0,'L');
$pdf->Cell(20,20,''.$row['dia'],0,0,'L');
$pdf->Cell(10,20,'/',0,0,'L');
$pdf->Cell(20,20,''.$row['mes'],0,0,'L');
$pdf->Cell(10,20,'/',0,0,'L');
$pdf->Cell(20,20,''.$row['ano'],0,0,'L');

$pdf->Output("arquivo.pdf","I");

?>