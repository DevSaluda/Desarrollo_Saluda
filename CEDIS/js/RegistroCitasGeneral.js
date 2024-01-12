function CargaSignosVitalesLibre(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/RegistroLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
