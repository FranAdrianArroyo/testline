<?php
include_once '../dbConnection.php';
require('../fpdf182/fpdf.php');

class PDF extends FPDF{
    

    // Cabecera de página
    function Header(){
        // Logo
        $this->Image('../image/background.png',-10,-10,640);
        $this->Image('../image/pdf1.jpeg',-4,-10,90);
        $this->Image('../image/pdf2.jpg',350,1,80);
        // Arial bold 15
        $this->SetFont('Arial','B',30);
        // Movernos a la derecha
        $this->Cell(100);

        $this->SetFont('Arial','B',31);
    
        // Título
        $this->SetFont('Arial','B',30);
        $this->Cell(200,10,utf8_decode('Evaluación final'),0,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer(){
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm','A3');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',15);

$eid=@$_GET['eid'];
$scn=@$_GET['scn'];
$q=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );

while($row=mysqli_fetch_array($q) ){
    $title=$row['title'];
    $sub=$row['subject'];
    $group=$row['groupnum'];
    $date=$row['date'];
    $empnum=$row['employnumber'];
    $q2=mysqli_query($con,"SELECT * FROM teacher WHERE employnumber='$empnum' " );
    while($row=mysqli_fetch_array($q2) ){
        $tea=$row['name'];
    }
}

$pdf->Ln(10);

$pdf->SetFont('Times','B',20);
$pdf->SetLineWidth(0.5);
$pdf->Cell(400,10,utf8_decode("Profesor aplicador:  $tea"),1,1,'L');
$pdf->Cell(400,10,utf8_decode("Asignatura:  $sub"),1,1,'L');
$pdf->Cell(400,10,utf8_decode("Examen aplicado:  $title"),1,1,'L');
$pdf->Cell(400,10,utf8_decode("Grupo del alumno:  $group"),1,1,'L');
$pdf->Ln(20);

$pdf->SetFont('Times','B',18);

$pdf->Cell(45,10,utf8_decode('Matrícula'),1,0,'C');
$pdf->Cell(100,10,utf8_decode('Alumno'),1,0,'C');
$pdf->Cell(35,10,utf8_decode('Pt. Máx.'),1,0,'C');
$pdf->Cell(35,10,utf8_decode('Pt. Ob.'),1,0,'C');
$pdf->Cell(20,10,utf8_decode('Res. C.'),1,0,'C');
$pdf->Cell(35,10,utf8_decode('Res. I.'),1,0,'C');
$pdf->Cell(35,10,utf8_decode('Porcentaje'),1,0,'C');
$pdf->Cell(60,10,utf8_decode('Estatus'),1,1,'C');

$pdf->SetFont('Times','',12);

if($group!=='0000'){
    $q3=mysqli_query($con,"SELECT * FROM user WHERE groupnum = '$group' AND schoolnumber = '$scn'ORDER BY last_name ASC") or die('Error');
    while($row = mysqli_fetch_array($q3)) {
    $nam=$row['name'];
    $scn=$row['schoolnumber'];
    $lname=$row['last_name'];
    $student=$lname." ".$nam;

        $q4=mysqli_query($con,"SELECT * FROM qualification WHERE eid = '$eid' AND schoolnumber = $scn") or die('Error');
        while($row = mysqli_fetch_array($q4)) {
            $ts=$row['total_score'];
            $fs=$row['final_score'];
            $rans=$row['right_ans'];
            $wans=$row['wrong_ans'];
            $st=$row['status'];
            $pc=$row['porcent'];


            if ($pc >= 70) {
                $st = 'APROBADO';
            }else{
                $st = 'NO APROBADO';
            }

            $pdf->SetFont('Times','B',18);

            $pdf->Cell(45,10,utf8_decode($scn),1,0,'C');
            $pdf->Cell(100,10,utf8_decode($student),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($ts.'pts.'),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($fs.'pts.'),1,0,'C');
            $pdf->Cell(20,10,utf8_decode($rans),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($wans),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($pc.'%'),1,0,'C');
            $pdf->Cell(60,10,utf8_decode($st.''),1,1,'C');
            $pdf->MultiCell(410, 145, utf8_decode("--------------------------------------------------------"),0,'C'); 
            $pdf->MultiCell(410, -100, utf8_decode("Firma"),0,'C'); 
        }
    }
}
else{
    $q3=mysqli_query($con,"SELECT * FROM user WHERE schoolnumber = '$scn'ORDER BY last_name ASC") or die('Error');
    while($row = mysqli_fetch_array($q3)) {
        $nam=$row['name'];
        $scn=$row['schoolnumber'];
        $lname=$row['last_name'];
        $student=$lname." ".$nam;

        $q4=mysqli_query($con,"SELECT * FROM qualification WHERE eid = '$eid' AND schoolnumber = $scn") or die('Error');
        while($row = mysqli_fetch_array($q4)) {
            $ts=$row['total_score'];
            $fs=$row['final_score'];
            $rans=$row['right_ans'];
            $wans=$row['wrong_ans'];
            $st=$row['status'];
            $pc=$row['porcent'];


            if ($pc >= 70) {
                $st = 'APROBADO';
            }else{
                $st = 'NO APROBADO';
            }

            $pdf->SetFont('Times','B',18);

            $pdf->Cell(45,10,utf8_decode($scn),1,0,'C');
            $pdf->Cell(100,10,utf8_decode($student),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($ts.'pts.'),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($fs.'pts.'),1,0,'C');
            $pdf->Cell(20,10,utf8_decode($rans),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($wans),1,0,'C');
            $pdf->Cell(35,10,utf8_decode($pc.'%'),1,0,'C');
            $pdf->Cell(60,10,utf8_decode($st.''),1,1,'C');
            $pdf->MultiCell(410, 145, utf8_decode("--------------------------------------------------------"),0,'C'); 
            $pdf->MultiCell(410, -100, utf8_decode("Firma"),0,'C'); 
        }
    }
}




$pdf->Output();
?>