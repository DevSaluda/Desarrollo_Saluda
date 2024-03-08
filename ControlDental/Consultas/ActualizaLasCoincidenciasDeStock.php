<?php
include("db_connection.php");
    $id_record = 0;
    
                                foreach($_POST['existenciasnuevas'] as $Existencias_R){
                
        $id = $_POST["folio"][$id_record++];
    $sql_update = $conn->query("UPDATE Stock_POS SET Existencias_R='$Existencias_R' WHERE Folio_Prod_Stock='$id' ");
        
        
     }
?>