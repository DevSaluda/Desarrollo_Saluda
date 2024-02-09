function CargaEmpleados(){
    $.get("https://saludapos.com/AdminPOS/Consultas/CallCenter.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  