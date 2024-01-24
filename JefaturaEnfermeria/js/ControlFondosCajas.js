function CargaFCajas(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/FondosCajas.php","",function(data){
      $("#FCajas").html(data);
    })
  
  }
  
  
  
  CargaFCajas();

  
  