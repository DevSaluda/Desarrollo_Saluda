<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php
session_start();
$connect=mysqli_connect('localhost', 'somosgr1_SHWEB', 'yH.0a-v?T*1R', 'somosgr1_Sistema_Hospitalario');
if ($connect) {
        echo "conexion exitosa. <br />";
       
        $ID_DIAGNOSTICO='';											
		$Nombre_Paciente= $_POST ['Nombre'];
		$Edad= $_POST ['Edad'];
        $Sexo= $_POST ['Sexo'];
        $Talla= $_POST ['Talla'];  
        $Peso= $_POST ['Peso'];
        $Temp= $_POST ['Temp'];
        $TA= $_POST ['TA'];
        $FC= $_POST ['FC'];
        $FR= $_POST ['FR'];
        $DxTx= $_POST ['DxTx'];
        $Sa02= $_POST ['SaO2'];
        $Alergias= $_POST ['Alergia'];
        $Motivo_Consulta= $_POST ['Consulta'];
        $Nombres_Enfermero= $_POST ['Enfermero'];
        $Nombre_Doctor= $_POST ['Doc'];
        $Fk_Sucursal= $_POST ['SC'];
        $FK_ID_H_O_D= $_POST ['Propiedad'];
        $ID_TURNO= $_POST ['Turno'];
        $Fecha_Consulta= $_POST ['FechaConsulta'];
        $Hora_Cita= $_POST ['Hora'];
        $Telefono= $_POST ['Tel'];
        $Correo= $_POST ['Correo'];
        $Lugar_procedencia= $_POST ['Procede'];
        $Enterado= $_POST ['Entero'];
        $Visita= $_POST ['Visita'];

		
		
	
	
$consulta="insert into Signos_Vitales values 
('$ID_DIAGNOSTICO','$Nombre_Paciente','$Edad','$Sexo','$Talla','$Peso','$Temp','$TA','$FC','$FR','$DxTx','$Sa02','$Alergias',
'$Motivo_Consulta','$Nombres_Enfermero','$Nombre_Doctor','$Fk_Sucursal','$FK_ID_H_O_D','$ID_TURNO','$Fecha_Consulta','$Hora_Cita',
'$Telefono','$Correo','$Lugar_procedencia','$Enterado','$Visita')";
		
		$resultado=mysqli_query($connect,$consulta);
		
		if ($resultado) {
		
	
		}
		else {
			echo '<script>
			Swal.fire({
				icon: "error",
				title: "Datos no validos...",
				text: "Usuario o contraseña incorrectos.",
				showConfirmButton: true,
			  })
			</script>';
		}
		
		if (mysqli_close($connect)){ 
			
		} 
		else {
		
		}
}
						
?>