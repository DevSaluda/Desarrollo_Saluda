function CargaMobiAsignados(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/MobilariosAsignados.php","",function(data){
      $("#TablaMobiliariosAsignados").html(data);
    })

  }
  
  
  
  CargaMobiAsignados();