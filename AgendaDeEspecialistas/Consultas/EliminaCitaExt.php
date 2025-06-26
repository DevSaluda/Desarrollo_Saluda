<?php
include "db_connection.php";

        $ID_Agenda_Especialista=$conn -> real_escape_string(htmlentities(strip_tags(Trim($_POST['idcancelaExt']))));
     
  

        // 1. Obtener los IDs de Fecha y Horario asociados a la agenda
        $sql_get = "SELECT Fecha, Hora FROM AgendaCitas_EspecialistasExt WHERE ID_Agenda_Especialista=$ID_Agenda_Especialista";
        $result = mysqli_query($conn, $sql_get);
        if ($row = mysqli_fetch_assoc($result)) {
            $id_fecha = $row['Fecha'];
            $id_hora = $row['Hora'];

            // 2. Actualizar estado de la agenda a 'Cancelado'
            $sql_update_agenda = "UPDATE AgendaCitas_EspecialistasExt SET Estatus_cita='Cancelado' WHERE ID_Agenda_Especialista=$ID_Agenda_Especialista";
            $agenda_ok = mysqli_query($conn, $sql_update_agenda);

            // 3. Actualizar estado de la fecha a 'Disponible'
            $sql_update_fecha = "UPDATE Fechas_EspecialistasExt SET Estado='Disponible' WHERE ID_Fecha_Esp=$id_fecha";
            $fecha_ok = mysqli_query($conn, $sql_update_fecha);

            // 4. Actualizar estado de la hora a 'Disponible'
            $sql_update_hora = "UPDATE Horarios_Citas_Ext SET Estado='Disponible' WHERE ID_Horario=$id_hora";
            $hora_ok = mysqli_query($conn, $sql_update_hora);

            if ($agenda_ok && $fecha_ok && $hora_ok) {
                echo json_encode(array("statusCode"=>200));
            } else {
                echo json_encode(array("statusCode"=>201));
            }
        } else {
            echo json_encode(array("statusCode"=>404, "message"=>"No se encontró la agenda"));
        }
        mysqli_close($conn);
    ?>