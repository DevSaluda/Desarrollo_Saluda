function CargaResultadosUltras(){


    $.get("https://saludapos.com/ServiciosEspecializados/Consultas/EntregaUltrasF.php","",function(data){
      $("#TablaResultadosUltrasonidos").html(data);
    })
  
  }
  
  
  
  CargaResultadosUltras();

  
