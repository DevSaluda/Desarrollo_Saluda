function CargaCajas(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Cajas.php","",function(data){
      $("#Cajas").html(data);
    })
  
  }
  
  
  
  CargaCajas();

  
  