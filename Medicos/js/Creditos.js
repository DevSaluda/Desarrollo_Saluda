function CargaCreditos(){


    $.post("https://saludapos.com/ControlDental/Consultas/Creditos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaCreditos();