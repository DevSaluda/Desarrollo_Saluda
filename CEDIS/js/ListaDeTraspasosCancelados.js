function CargaProductos(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/ListaTraspasosCancelados.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos(); 