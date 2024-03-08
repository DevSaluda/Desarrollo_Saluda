function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/EmpleadosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  