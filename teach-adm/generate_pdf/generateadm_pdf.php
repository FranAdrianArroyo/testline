<?php
include_once '../../dbConnection.php';
require('../../fpdf182/fpdf.php');

class PDF extends FPDF{
    

    // Cabecera de página
    function Header(){
        // Logo
        $this->Image('../../image/pdf1.jpeg',-10,-10,100);
        $this->Image('../../image/pdf2.jpg',220,3,70);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(100);
        // Título
        $this->Cell(80,10,'Lista de Calificaciones',1,0,'C');
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
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$eid=@$_GET['eid'];

$q=mysqli_query($con,"SELECT * FROM qualification WHERE eid='$eid' " );
         $aprobado =0;
         $reprobado = 0;

while($row = mysqli_fetch_array($q)) {
        
    
         $pc=$row['porcent'];


          if ($pc >= 70) {
           
            $aprobado=$aprobado+1;
            
        }else{
            
           
            $reprobado=$reprobado+1;
        }
}


$q2=mysqli_query($con,"SELECT * FROM quiz WHERE eid='$eid' " );

while($row=mysqli_fetch_array($q2) ){
    $title=$row['title'];
    $sub=$row['subject'];
    $group=$row['groupnum'];
    $empnum=$row['employnumber'];
    $q3=mysqli_query($con,"SELECT * FROM teacher WHERE employnumber='$empnum' " );
    while($row=mysqli_fetch_array($q3) ){
        $teacher=$row['name'];
    }
}

$pdf->Ln(10);

$pdf->SetLineWidth(0.5);
$pdf->Cell(0,10,utf8_decode('Profesor: '.$teacher),1,1,'L');
$pdf->Cell(0,10,utf8_decode('Asignatura: '.$sub),1,1,'L');
$pdf->Cell(0,10,utf8_decode('Evaluación: '.$title),1,1,'L');
$pdf->Cell(0,10,utf8_decode('Grupo: '.$group),1,1,'L');
$pdf->Cell(0,10,utf8_decode('Total de aprobados: '.$aprobado),1,1,'C');
$pdf->Cell(0,10,utf8_decode('Total de reprobados: '.$reprobado),1,1,'C');

$pdf->Ln(20);

$pdf->SetFont('Times','B',12);

$pdf->Cell(35,10,utf8_decode('Matrícula'),1,0,'C');
$pdf->Cell(65,10,utf8_decode('Alumno'),1,0,'C');
$pdf->Cell(25,10,utf8_decode('Pt. Máx.'),1,0,'C');
$pdf->Cell(25,10,utf8_decode('Pt. Ob.'),1,0,'C');
$pdf->Cell(25,10,utf8_decode('Res. C.'),1,0,'C');
$pdf->Cell(25,10,utf8_decode('Res. I.'),1,0,'C');
$pdf->Cell(25,10,utf8_decode('Porcentaje'),1,0,'C');
$pdf->Cell(33,10,utf8_decode('Estatus'),1,1,'C');


$pdf->SetFont('Times','',12);

$q4=mysqli_query($con,"SELECT * FROM user WHERE groupnum = '$group' ORDER BY last_name ASC") or die('Error');
    while($row = mysqli_fetch_array($q4)) {
    $nam=$row['name'];
    $scn=$row['schoolnumber'];
    $lname=$row['last_name'];
    $student=$lname." ".$nam;

    $q5=mysqli_query($con,"SELECT * FROM qualification WHERE eid = '$eid' AND schoolnumber = $scn") or die('Error');
    while($row = mysqli_fetch_array($q5)) {
        $ts=$row['total_score'];
        $fs=$row['final_score'];
        $rans=$row['right_ans'];
        $wans=$row['wrong_ans'];
        $pc=$row['porcent'];
        $st=$row['status'];
    

        if ($pc >= 70) {
            $st = 'APROBADO';
            
        }else{
            $st = 'REPROBADO';
            
        }

        
      
        $pdf->Cell(35,10,utf8_decode($scn),1,0,'C');
        $pdf->Cell(65,10,utf8_decode($student),1,0,'C');
        $pdf->Cell(25,10,utf8_decode($ts.'pts.'),1,0,'C');
        $pdf->Cell(25,10,utf8_decode($fs.'pts.'),1,0,'C');
        $pdf->Cell(25,10,utf8_decode($rans),1,0,'C');
        $pdf->Cell(25,10,utf8_decode($wans),1,0,'C');
        $pdf->Cell(25,10,utf8_decode($pc.'%'),1,0,'C');
        $pdf->Cell(33,10,utf8_decode($st.''),1,1,'C');
       
    }
  }


$pdf->Output();
?>