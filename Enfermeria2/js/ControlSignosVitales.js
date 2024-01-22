function CargaSignosVitales(){


    $.get("https://controlfarmacia.com/Enfermeria2/Consultas/SignosVitales.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
