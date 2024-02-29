<?php
require('Consultas/Pdf/fpdf.php');

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


include('ComponentesEstudios/conne.php');
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
    $pdf->Cell(0, 190, $pdf->Image('https://saludapos.com/ServiciosEspecializados/' . $row['location'], 0, 0, 297, 210, 'JPG'));

    }
  }<?php
  require('Consultas/Pdf/fpdf.php');
  
  class PDF extends FPDF
  {
      // Cabecera de página
      function Header()
      {
          // Inserta aquí tu cabecera si la necesitas
      }
  
      // Pie de página
      function Footer()
      {
          // Position at 1.5 cm from bottom
          $this->SetY(-10);
          // Arial italic 8
          $this->SetFont('Arial','I',8);
          // Page number
          $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
      }
  }
  
  // Conexión a la base de datos
  include('ComponentesEstudios/conne.php');
  
  // Verifica si se proporciona el parámetro Nombre_paciente
  if(isset($_GET["Nombre_paciente"])) {
      $Nombre = $_GET["Nombre_paciente"];
  
      // Consulta SQL preparada para evitar inyección SQL
      $query = $conn->prepare("SELECT Nombre_paciente, Telefono, ID_Sucursal FROM Resultados_Ultrasonidos WHERE Nombre_paciente = ?");
      $query->bind_param("s", $Nombre);
      $query->execute();
      $query->store_result();
  
      // Verifica si se encontraron resultados
      if ($query->num_rows > 0) {
          $query->bind_result($nombrepdf, $nombrepdf2, $nombrepdf3);
          $query->fetch();
      } else {
          // Manejo de caso en que no se encuentran resultados
          die("No se encontraron resultados para el paciente proporcionado.");
      }
  
      // Consulta para obtener las imágenes del paciente
      $queryImages = $conn->prepare("SELECT location FROM Fotografias WHERE Fk_Nombre_paciente = ?");
      $queryImages->bind_param("s", $Nombre);
      $queryImages->execute();
      $resultImages = $queryImages->get_result();
  } else {
      // Manejo de caso en que no se proporciona el parámetro Nombre_paciente
      die("El parámetro Nombre_paciente no fue proporcionado.");
  }
  
  // Creación del objeto de la clase heredada
  $pdf = new PDF('L','mm','A4'); 
  $pdf->AddPage();
  $pdf->SetY(0);
  $pdf->SetX(0);
  
  // Añade las imágenes al PDF
  if ($resultImages->num_rows > 0) {
      while($row = $resultImages->fetch_assoc()){ 
          $imagePath = 'https://saludapos.com/ServiciosEspecializados/' . $row['location'];
          if (@getimagesize($imagePath)) {
              $pdf->Cell(0, 190, $pdf->Image($imagePath, 0, 0, 297, 210, 'JPG'));
          } else {
              // Manejo de caso en que no se puede cargar la imagen
              echo "No se pudo cargar la imagen: $imagePath";
          }
      }
  }
  
  // Añade el logotipo al PDF
  $pdf->Image('ComponentesEstudios/logo-ultra.jpeg', 0, 0, 297, 210, 'JPEG');
  
  $pdf->Output(''.$nombrepdf.' '.$nombrepdf2.' '.$nombrepdf3.'.pdf', 'I', true); 
  
  ?>
  
$pdf->Image('ComponentesEstudios/logo-ultra.jpeg' ,0 ,0,297 ,210,'JPEG');

$pdf->Output(''.$nombrepdf.' '.$nombrepdf2.' '.$nombrepdf3.'.pdf', 'I',true); 

?>