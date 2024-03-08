function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/IntendenciaBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    