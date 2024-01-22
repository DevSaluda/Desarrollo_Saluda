function CargaProductos(){


  $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();