function CargaSignosVitales(){


    $.get("https://saludapos.com/Enfermeria2/Consultas/SignosVitales.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
