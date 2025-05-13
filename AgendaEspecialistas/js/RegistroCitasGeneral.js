function CargaSignosVitalesLibre(){


    $.get("https://saludapos.com/AgendaDeCitas/Consultas/RegistroLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
