<?php
    include_once 'db_connection.php';

$Fk_Folio_Credito=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FolioCreditoRC']))));
$Folio_Ticket=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['NumeroTicketRC']))));

$Nombre_Cred=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['TitularCreditoRC']))));
$Cantidad_Prod=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['CantidadTicketR'])))); 
$SaldoAnterior=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SaldoActualTicketRC']))));
$Cant_Abono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['AbonoleticketR']))));
$Fecha_Abono=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['FechaAbonoRC']))));
$Saldo=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SaldoTicketR']))));
$Fk_Sucursal=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SucursalRC']))));
$Agrega=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['VendedorTicketRC']))));
$Pagoen=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['HoraPagoRC']))));
$Sistema=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['SistemaCajaRC']))));
$ID_H_O_D=  $conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['EmpresaCajaRC']))));   

//include database configuration file
    
    
  $sql = "INSERT INTO `ReimpresionesTickets_CreditosClinicas`( `Fk_Folio_Credito`, `Folio_Ticket`,`Nombre_Cred`,`Cantidad_Prod`,
   `SaldoAnterior`, `Cant_Abono`, `Fecha_Abono`, `Saldo`, `Fk_Sucursal`, `Agrega`, `Pagoen`, `Sistema`, `ID_H_O_D`) 
            VALUES ( '$Fk_Folio_Credito','$Folio_Ticket','$Nombre_Cred','$Cantidad_Prod',
   '$SaldoAnterior','$Cant_Abono','$Fecha_Abono', '$Saldo', '$Fk_Sucursal','$Agrega','$Pagoen','$Sistema','$ID_H_O_D')";
        
            if (mysqli_query($conn, $sql)) {
               
                echo json_encode(array("statusCode"=>900));
             
            } 
            else {
                echo json_encode(array("statusCode"=>901));
            }
            mysqli_close($conn);
        

?>