function MedicosCreditos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/MedicosCreditos.php","",function(data){
      $("#TableMedicosCreditos").html(data);
    })

  }
  
  
  
  MedicosCreditos();