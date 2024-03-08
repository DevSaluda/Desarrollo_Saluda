   <?php
    include "db_connection.php";
    
            $ID_Sol_Traspaso=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['ID_Auto_Recha']))));
         
           $Estatus=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['Estado']))));
            
            $sql = "UPDATE `Solicitudes_Traspasos` 
            SET `Estatus`='$Estatus'
    WHERE ID_Sol_Traspaso=$ID_Sol_Traspaso";
           if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($conn);
    ?>