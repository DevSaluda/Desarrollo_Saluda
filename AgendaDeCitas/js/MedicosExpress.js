function CargaMedicosExpress(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/MedicosExpress.php","",function(data){
      $("#DoctoresExpress").html(data);
    })
  
  }
  
  CargaMedicosExpress();

  
