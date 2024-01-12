function CargaSignosVitalesLibre(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/RegistroLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
