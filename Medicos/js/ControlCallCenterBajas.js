function CargaEmpleadosBajas(){
    $.get("https://saludapos.com/AdminPOS/Consultas/CallCenterBaja.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  