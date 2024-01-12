function CargaCampanasDias(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/CampanasDias.php","",function(data){
      $("#TablaCampanas").html(data);
    })
  
  }
  
  
  
  CargaCampanasDias();
