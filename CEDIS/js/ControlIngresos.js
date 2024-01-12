function IngresosProductos(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/IngresosProductos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })
  
  }
  
  
  IngresosProductos();

  
