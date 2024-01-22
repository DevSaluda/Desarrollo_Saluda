function EntraYSalez(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/EntraYSaleLibre.php","",function(data){
      $("#Logs").html(data);
    })
  
  }
  
  
  EntraYSalez();

  
