<?php
include_once '../../dbConnection.php';
require('../../fpdf182/fpdf.php');

class PDF extends FPDF{
    

    // Cabecera de página
    function Header(){
        // Logo
        $this->Image('../../image/plantilla.png',-75,8,550);
        
        $this->SetFont('Arial','B',31);
        // Movernos a la derecha
        $this->Cell(100);
        //TITULO
        //$this->Cell(230,55,utf8_decode("TECNOLÓGICO NACIONAL DE MÉXICO "),0,0,'C');
        //TITULO
        $this->SetFont('Arial','B',31);
        $this->Cell(225,59,utf8_decode("TECNOLÓGICO DE ESTUDIOS SUPERIORES DE IXTAPALUCA"),0,0,'C');
        //TITULO
         $this->SetFont('Arial','B',22);
        $this->Cell(-225,90,utf8_decode("ORGANISMO PÚBLICO DESCENTRALIZADO DE MÉXICO"),0,0,'C');
        //TITULO
        $this->SetFont('Arial','B',19);
       $this->Cell(225,120,utf8_decode("OTORGA EL PRESENTE"),0,0,'C');
        //TITULO
        $this->SetFont('Arial','B',30);
        $this->Cell(-225,150,utf8_decode("CERTIFICADO"),0,0,'C');

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


/*$pdf->SetFont('Times','B',16);
$pdf->MultiCell(200, 50, utf8_decode("El Tecnológico de Estudios Superiores de Ixtapaluca Certifica a"),0,'C');*/

$pdf->SetFont('Times','B',16);

$q3=mysqli_query($con,"SELECT * FROM user WHERE groupnum = '$group' ORDER BY last_name ASC") or die('Error');
    while($row = mysqli_fetch_array($q3)) {
    $nam=$row['name'];
    $scn=$row['schoolnumber'];
    $lname=$row['last_name'];
    $student=$lname." ".$nam;

    $q4=mysqli_query($con,"SELECT * FROM qualification WHERE eid = '$eid' AND porcent >=70 AND schoolnumber = $scn") or die('Error');
    while($row = mysqli_fetch_array($q4)) {
         
        $pc=$row['porcent'];
        $pdf->SetFont('Times','B',29);
        $pdf->MultiCell(420, 150, utf8_decode("A: $student"),0,'C');
        $pdf->SetFont('Times','B',22);
        $pdf->MultiCell(420, -120, utf8_decode("Con la matrícula: $scn "),0,'C');
        $pdf->MultiCell(420, 155, utf8_decode("Por haber aprobado el examen $title, en el curso $sub de manera satisfactoria. "),0,'C');
        $pdf->MultiCell(450, -125, utf8_decode("Con un porcentaje de: $pc % "),0,'C');  
        $pdf->MultiCell(439, 170, utf8_decode("Fecha: $date"),0,'R'); 
        $pdf->MultiCell(410, -120, utf8_decode("Director Escolar Demetrio Moreno Arcega"),0,'C');    
        //$pdf->MultiCell(250, 64, utf8_decode("Profesor $tea "),0,'R'); */ 
        
    }
}


$pdf->Output();
?>