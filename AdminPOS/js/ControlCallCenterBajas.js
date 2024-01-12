function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/CallCenterBaja.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  