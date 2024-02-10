function CargaProspectos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/Prospectos.php","",function(data){
      $("#tablaProspectos").html(data);
    })

  }
  
  
  
  CargaProspectos();