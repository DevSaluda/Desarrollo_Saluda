function CargaCajas(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Cajas.php","",function(data){
      $("#Cajas").html(data);
    })
  
  }
  
  
  
  CargaCajas();

  
  