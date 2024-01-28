function CargaResultadosUltras(){


    $.get("https://controlfarmacia.com/Servicios_Especializados/Consultas/EntregaUltrasF.php","",function(data){
      $("#TablaResultadosUltrasonidos").html(data);
    })
  
  }
  
  
  
  CargaResultadosUltras();

  
