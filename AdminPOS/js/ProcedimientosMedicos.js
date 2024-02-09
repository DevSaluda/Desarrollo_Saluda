function CargaProcedimientos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ProcedimientosMedicos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaProcedimientos();