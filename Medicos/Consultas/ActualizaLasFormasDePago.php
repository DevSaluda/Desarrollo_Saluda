<?php
include("db_connection.php");
    $id_record = 0;
    
                                foreach($_POST['formapago'] as $Existencias_R){
                
        $id = $_POST["codigo"][$id_record++];
    $sql_update = $conn->query("UPDATE Ventas_POS SET 	FormaDePago='$Existencias_R' WHERE Venta_POS_ID='$id' ");
        
        
     }
?>