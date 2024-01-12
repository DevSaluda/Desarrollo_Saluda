function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/RolesBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  