function CargaSignosVitales(){


    $.get("https://saludapos.com/AgendaDeCitas/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
 