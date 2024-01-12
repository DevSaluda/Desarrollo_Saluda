function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Enfermeros.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  