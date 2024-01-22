function CargaStock(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/StockEnfermeros.php","",function(data){
      $("#StockEnfermeros").html(data);
    })
  
  }
  
  
  CargaStock();

  
