function CargaSignosVitales(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
 