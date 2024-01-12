function CargaSignosVitalesLibre(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/MotivosConsultaLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
