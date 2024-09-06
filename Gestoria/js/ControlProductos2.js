function CargaProductos(){


  $.post("https://saludapos.com/Gestoria/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();