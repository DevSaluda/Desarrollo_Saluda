function IngresosProductos(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/IngresosProductos.php","",function(data){
      $("#TableStockSucursales").html(data);
    })
  
  }
  
  
  IngresosProductos();

  
