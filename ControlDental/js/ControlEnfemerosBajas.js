function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/EnfermerosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  