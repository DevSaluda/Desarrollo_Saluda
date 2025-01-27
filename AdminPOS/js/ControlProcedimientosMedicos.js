function ServiciosCarga(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ProcedimientosMedicos.php","",function(data){
        $("#TableProcedimientos").html(data);

    })

  }
  
  
  
  ServiciosCarga();