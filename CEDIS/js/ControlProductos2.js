function CargaProductos(){


  $.post("https://controlfarmacia.com/CEDIS/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();