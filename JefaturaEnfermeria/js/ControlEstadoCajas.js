function  HistorialCajas(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/HistorialCajas.php","",function(data){
      $("#CajasHistoricas").html(data);
    })

  }
  
  
  
  HistorialCajas();