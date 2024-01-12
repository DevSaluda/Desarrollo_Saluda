function CargaProspectos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/Prospectos.php","",function(data){
      $("#tablaProspectos").html(data);
    })

  }
  
  
  
  CargaProspectos();