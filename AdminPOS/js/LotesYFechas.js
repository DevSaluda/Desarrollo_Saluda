function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/LotesYfechasDeCaducidades.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();