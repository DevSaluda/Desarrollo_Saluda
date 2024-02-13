function CargaChecadorGeneral(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/ChecadorGeneral","",function(data){
      $("#ChecadorGeneral").html(data);
    })
  
  }
  
  
  CargaChecadorGeneral();

  
