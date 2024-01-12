<?php
require('Pdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página


// Pie de página
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    // $this->Cell(0,190,$this->Image('ComponentesEstudios/logo.png' ,240 ,185,55 ,30,'PNG'));
    
}
}


include("Consultas/db_connection.php");
$Nombre= $_GET["Nombre_paciente"];
$query=mysqli_query($conn,"SELECT Nombre_paciente,Telefono,ID_Sucursal FROM Resultados_Ultrasonidos where Nombre_paciente='$Nombre'");
if ($query->num_rows > 0) {
  while($datos = $query->fetch_assoc()){
    $nombrepdf = $datos['Nombre_paciente'];
    $nombrepdf2 = $datos['Telefono'];
    $nombrepdf3 = $datos['ID_Sucursal'];
  
    }
  }
$query=mysqli_query($conn,"SELECT Fk_Nombre_paciente,location FROM Fotografias where Fk_Nombre_paciente='$Nombre'");


// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm','A4'); 
$pdf->AddPage();
$pdf->SetY(0);
$pdf->SetX(0);

//Aqui es donde se hace la consulta, para llamar a las fotografias
if ($query->num_rows > 0) {
  while($row = $query->fetch_assoc()){ 
      $pdf->Cell(0,190,$pdf->Image($row['location'],0,0,297,210,'JPG')); 
    }
  }

$pdf->Image('ComponentesEstudios/logo-ultra.jpeg' ,0 ,0,297 ,210,'JPEG');

$pdf->Output(''.$nombrepdf.' '.$nombrepdf2.' '.$nombrepdf3.'.pdf', 'I',true); 

?>