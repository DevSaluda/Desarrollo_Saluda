function CargaProveedores(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Proveedores.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaProveedores();

  