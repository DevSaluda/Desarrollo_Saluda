function CargaMobiPorAgregar(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/MobilariosVigentesPorAgregar.php","",function(data){
      $("#TablaMobiliariosAsigna").html(data);
    })

  }
  
  
  
  CargaMobiPorAgregar();