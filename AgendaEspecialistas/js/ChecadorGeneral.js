function CargaChecadorGeneral(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/ChecadorGeneral","",function(data){
      $("#ChecadorGeneral").html(data);
    })
  
  }
  
  
  CargaChecadorGeneral();

  
