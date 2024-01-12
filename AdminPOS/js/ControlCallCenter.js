function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/CallCenter.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  