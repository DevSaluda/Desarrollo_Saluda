function CargaProductos(){


  $.post("https://saludapos.com/ControlDental/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();