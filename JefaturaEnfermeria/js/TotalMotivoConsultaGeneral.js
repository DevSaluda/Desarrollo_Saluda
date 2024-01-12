function CargaSignosVitalesLibre(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/MotivosConsultaLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
