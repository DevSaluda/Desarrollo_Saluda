function  HistorialCajas(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/HistorialCajas.php","",function(data){
      $("#CajasHistoricas").html(data);
    })

  }
  
  
  
  HistorialCajas();