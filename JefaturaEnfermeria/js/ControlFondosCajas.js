function CargaFCajas(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/FondosCajas.php","",function(data){
      $("#FCajas").html(data);
    })
  
  }
  
  
  
  CargaFCajas();

  
  