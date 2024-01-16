function  HistorialCajas(){


    $.post("https://saludapos.com/AdminPOS/Consultas/HistorialCajas.php","",function(data){
      $("#CajasHistoricas").html(data);
    })

  }
  
  
  
  HistorialCajas();