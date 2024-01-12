function  HistorialCajas(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/HistorialCajas.php","",function(data){
      $("#CajasHistoricas").html(data);
    })

  }
  
  
  
  HistorialCajas();