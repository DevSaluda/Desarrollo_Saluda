function CargaProductos(){


  $.post("https://controlfarmacia.com/CEDISMOVIL/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();