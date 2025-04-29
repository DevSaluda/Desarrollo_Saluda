<?php
	include('conn.php');
	
	// Manejo de errores y logging
	function log_debug($msg) {
    $log_file = __DIR__ . '/debug_subefotos.log';
    // Si el archivo no existe, intenta crearlo
    if (!file_exists($log_file)) {
        $handle = fopen($log_file, 'a+');
        if ($handle === false) {
            // No se pudo crear el archivo
            error_log('No se pudo crear el archivo de log: ' . $log_file);
            return;
        }
        fclose($handle);
    }
    file_put_contents($log_file, date('Y-m-d H:i:s') . " - " . $msg . "\n", FILE_APPEND);
}

	// Log de inicio de ejecución
	log_debug('--- INICIO DE EJECUCIÓN SubeFotos.php ---');

	foreach ($_FILES['upload']['name'] as $key => $name){
		$newFilename = time() . "_" . $name;
		move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'upload/' . $newFilename);
		$location = 'upload/' . $newFilename;
		$Fk_Nombre_paciente = $_POST['Nombre']; 
		mysqli_query($conn,"insert into Fotografias (Fk_Nombre_paciente, location) values ('$Fk_Nombre_paciente','$location')");
	}

	// Actualizar el estatus en Resultados_Ultrasonidos para el paciente
	$estatus = isset($_POST['Estatus']) ? $_POST['Estatus'] : '';
	log_debug("Valor recibido en Estatus: '" . $estatus . "' para paciente: '" . $_POST['Nombre'] . "'");
	if (!empty($estatus) && !empty($_POST['Nombre'])) {
	    $update = mysqli_query($conn, "UPDATE Resultados_Ultrasonidos SET Estatus='$estatus' WHERE Nombre_paciente='" . $_POST['Nombre'] . "'");
	    if ($update) {
	        log_debug("Actualización exitosa de estatus a '$estatus' para " . $_POST['Nombre']);
	    } else {
	        log_debug("Error al actualizar estatus: " . mysqli_error($conn));
	    }
	} else {
	    log_debug("No se recibió Estatus o Nombre para actualizar");
	}

	header('location:https://controlfarmacia.com/Servicios_Especializados/index');
?>

