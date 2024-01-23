function  CargaGestionventas(){


    $.post("https://saludapos.com/POS2/VistaVentas.php","",function(data){
      $("#Tabladeventas").html(data);
    })

  }
  
  
  
  CargaGestionventas();