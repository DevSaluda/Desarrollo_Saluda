function CargaSignosVitalesLibre(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/RegistroLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
