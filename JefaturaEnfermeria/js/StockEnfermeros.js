function CargaStock(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/StockEnfermeros.php","",function(data){
      $("#StockEnfermeros").html(data);
    })
  
  }
  
  
  CargaStock();

  
