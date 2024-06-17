function CargaSignosVitalesLibre(){


    $.get("https://saludapos.com/ControlDental/Consultas/RegistroLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
