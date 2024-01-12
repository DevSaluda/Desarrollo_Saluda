function CargaSignosVitales(){


    $.get("https://controlconsulta.com/Enfermeria2/Consultas/SignosVitalesMasHojaDiaria.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
