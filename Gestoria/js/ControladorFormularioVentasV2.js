function  CargaGestionventas(){


    $.post("https://controlfarmacia.com/POS2/VistaVentasV2.php","",function(data){
      $("#Tabladeventas").html(data);
    })

  }
  
  
  
  CargaGestionventas();