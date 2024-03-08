function IngresosProductos(){


    $.get("https://saludapos.com/AdminPOS/Consultas/IngresosProductos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })
  
  }
  
  
  IngresosProductos();

  
