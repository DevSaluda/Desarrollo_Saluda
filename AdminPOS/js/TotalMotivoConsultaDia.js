function CargaSignosVitalesDia(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/MotivosConsultaDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesDia();

  
