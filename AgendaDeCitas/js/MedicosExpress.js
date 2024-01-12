function CargaMedicosExpress(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/MedicosExpress.php","",function(data){
      $("#DoctoresExpress").html(data);
    })
  
  }
  
  CargaMedicosExpress();

  
