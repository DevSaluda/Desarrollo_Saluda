<?php
if (!empty($_POST['MedicoHoras'])  || !empty($_POST['HorasAGuardar']) || !empty($_POST['EmpresaHoras'])) {

    foreach ($_POST['HorasAGuardar'] as $val) {
        foreach ($_POST['FechaAsignadaParaHoras'] as $val2) {
            foreach ($_POST['MedicoHoras'] as $FK_Especialista) {
                foreach ($_POST['NumberProgramaHoras'] as $Fk_Programacion) {
                    foreach ($_POST['EmpresaHoras'] as $ID_H_O_D) {
                        foreach ($_POST['UsuarioHoras'] as $AgregadoPor) {
                            include_once 'db_connection.php';





                            //insert form data in the database
                            $insert = $conn->query("INSERT Horarios_Citas_Ext (`Horario_Disponibilidad`, `ID_H_O_D`, `FK_Especialista`,`FK_Fecha`,`Fk_Programacion`, `AgregadoPor`) VALUES 
	('" . $val . "','" . $ID_H_O_D . "','" . $FK_Especialista . "','" . $val2 . "','" . $Fk_Programacion . "','" . $AgregadoPor . "')");
                        }
                    }
                }
            }
        }
    }
}
