<?php
    include_once 'db_connection.php';

$Fk_Folio_Credito=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FolioCreditoR']))));
$Folio_Ticket=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NumeroTicketR']))));
$Fk_tipo_Credi=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TramientoTicketR']))));
$Nombre_Cred=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TitularCreditoR']))));
$SaldoAnterior=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SaldoAnteriorTicketR']))));
$Cant_Abono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AbonoTicketR']))));
$Fecha_Abono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaAbonoR']))));
$Saldo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SaldoTicketR']))));
$Fk_Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalR']))));
$Validez=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaValidezR']))));
$Agrega=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VendedorTicketR']))));
$Pagoen=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['HoraPago']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaCajaR']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaCajaR']))));   

//include database configuration file
    
    
  $sql = "INSERT INTO `ReimpresionesTickets_CreditosDentales`( `Fk_Folio_Credito`, `Folio_Ticket`, `Fk_tipo_Credi`, `Nombre_Cred`,
   `SaldoAnterior`, `Cant_Abono`, `Fecha_Abono`, `Saldo`, `Fk_Sucursal`, `Validez`, `Agrega`, `Pagoen`, `Sistema`, `ID_H_O_D`) 
            VALUES ( '$Fk_Folio_Credito','$Folio_Ticket','$Fk_tipo_Credi','$Nombre_Cred',
   '$SaldoAnterior','$Cant_Abono','$Fecha_Abono', '$Saldo', '$Fk_Sucursal','$Validez','$Agrega','$Pagoen','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>900));
             
            } 
            else {
                echo json_encode(array("statusCode"=>901));
            }
            mysqli_close($conn);
        

?>