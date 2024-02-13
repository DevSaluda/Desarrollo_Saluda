function CargaSignosVitalesLibre(){


    $.get("https://saludapos.com/AdminPOS/Consultas/MotivosConsultaLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
