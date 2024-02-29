function CargaResultadosUltras(){


    $.get("https://saludapos.com/AgendaDeCitas/Consultas/EntregaUltrasF.php","",function(data){
      $("#TablaResultadosUltrasonidos").html(data);
    })
  
  }
  
  
  
  CargaResultadosUltras();

  
