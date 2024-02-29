<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php
session_start();
$connect=mysqli_connect('localhost', 'somosgr1_SHWEB', 'yH.0a-v?T*1R', 'somosgr1_Sistema_Hospitalario');
if ($connect) {
        echo "conexion exitosa. <br />";
        
       
        $ID_Agenda='';											
		$ID_H_O_D= $_POST ['Empresa'];
		$Sucursal= $_POST ['Sucursal'];
        $Fecha= $_POST ['Fecha'];
        $Hora_cita= $_POST ['Hora'];  
        $Tipo_analisis= $_POST ['id_deparatamento'];
        $Tipo_estudio	= $_POST ['municipio'];
        $Nombre_solicitante	= $_POST ['Nombre'];
        $Edad	= $_POST ['Edad'];
        $Telefono	= $_POST ['Telefono'];
      
        $Estado_cita= $_POST ['color'];
        $Nombre_empleado= $_POST ['Empleado'];
       

		
		
        							

	
$consulta="insert into AgendaCita_Analisis values 
('$ID_Agenda','$ID_H_O_D','$Sucursal','$Fecha','$Hora_cita','$Tipo_analisis','$Tipo_estudio','$Nombre_solicitante','$Edad','$Telefono','$Estado_cita','$Nombre_empleado')";
		
		$resultado=mysqli_query($connect,$consulta);
		
		if ($resultado==true) {
     
	
		}
		else {
		
		}
		
		if (mysqli_close($connect)){ 
			
		} 
		else {
		
		}
}
						
?>