function  CargaGestionventas(){


    $.post("https://saludapos.com/POS2/VistaVentasDesarrollo.php","",function(data){
      $("#Tabladeventas").html(data);
    })

  }
  
  
  
  CargaGestionventas();