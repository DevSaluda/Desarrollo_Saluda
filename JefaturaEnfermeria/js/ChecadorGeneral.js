function CargaChecadorGeneral(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ChecadorGeneral","",function(data){
      $("#ChecadorGeneral").html(data);
    })
  
  }
  
  
  CargaChecadorGeneral();

  
