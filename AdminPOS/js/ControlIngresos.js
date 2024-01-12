function IngresosProductos(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/IngresosProductos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })
  
  }
  
  
  IngresosProductos();

  
