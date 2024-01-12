function IngresosProductos(){


    $.get("https://controlfarmacia.com/CEDISMOVIL/Consultas/IngresosProductos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })
  
  }
  
  
  IngresosProductos();

  
