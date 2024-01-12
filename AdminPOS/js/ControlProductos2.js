function CargaProductos(){


  $.post("https://controlfarmacia.com/AdminPOS/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();