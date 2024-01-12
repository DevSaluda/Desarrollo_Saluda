function CargaProcedimientos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/ProcedimientosMedicos.php","",function(data){
      $("#tablaCreditos").html(data);
    })

  }
  
  
  
  CargaProcedimientos();