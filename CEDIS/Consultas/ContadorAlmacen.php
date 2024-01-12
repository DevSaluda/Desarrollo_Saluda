<?

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$sql ="SELECT COUNT(*) as TotalCategoriass FROM Categorias_POS where ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalCategorias = mysqli_fetch_assoc($resultset);


$sql ="SELECT COUNT(*) as TotalTipoProd FROM TipProd_POS WHERE ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalTipoProductos = mysqli_fetch_assoc($resultset);


$sql ="SELECT COUNT(*) as TotalPresentaciones FROM Presentacion_Prod_POS WHERE ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$Tpresentaciones = mysqli_fetch_assoc($resultset);

$sql ="SELECT COUNT(*) as TotalMarcas FROM Marcas_POS WHERE ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TotalMarcas = mysqli_fetch_assoc($resultset);

$sql ="SELECT COUNT(*) as TotalServiciosPOS FROM Servicios_POS WHERE ID_H_O_D='".$row['ID_H_O_D']."'"; 
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$TServicios = mysqli_fetch_assoc($resultset);
?>