function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Medicos.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  