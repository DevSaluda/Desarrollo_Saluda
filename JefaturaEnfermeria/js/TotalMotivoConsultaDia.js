function CargaSignosVitalesDia(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/MotivosConsultaDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesDia();

  
