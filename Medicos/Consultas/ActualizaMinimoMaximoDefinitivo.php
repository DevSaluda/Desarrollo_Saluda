<?php
include("db_connection.php");
    $id_record = 0;
    
                                foreach($_POST['MinimoPermitido'] as $Minimo){
                                    foreach($_POST['MaximoPermitido'] as $Maximo){
        $ID_Prod_POS = $_POST["CodProd"][$id_record++];
    $sql_update = $conn->query("UPDATE Stock_POS SET 	Min_Existencia='$Minimo', Max_Existencia ='$Maximo 'WHERE ID_Prod_POS='$ID_Prod_POS' ");
        
        
     }}
?>