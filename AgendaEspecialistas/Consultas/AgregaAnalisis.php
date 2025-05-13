<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php
session_start();
$connect=mysqli_connect('localhost', 'somosgr1_SHWEB', 'yH.0a-v?T*1R', 'somosgr1_Sistema_Hospitalario');
if ($connect) {
        echo "conexion exitosa. <br />";
        
       
        $ID_Analisis='';		
        $Nombre_analisis= $_POST ['NombreAnalisis'];									
		$ID_H_O_D= $_POST ['Empresa'];
		
		
		
        							

	
$consulta="insert into Tipo_analisis values 
('$ID_Analisis','$Nombre_analisis','$ID_H_O_D')";
		
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