function CargaEmpleados(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Usuarios.php","",function(data){
      $("#tablaUsuarios").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();