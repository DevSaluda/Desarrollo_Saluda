function CargaSignosVitalesLibre(){


    $.get("https://saludapos.com/AdminPOS/Consultas/RegistroLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
