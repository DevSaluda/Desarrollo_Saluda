function EntraYSalez(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/EntraYSale.php","",function(data){
      $("#Logs").html(data);
    })
  
  }
  
  
  EntraYSalez();

  
