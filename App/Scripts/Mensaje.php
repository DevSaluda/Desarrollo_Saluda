<?php 
  // Formato 24 horas (de 1 a 24) 
  $hora = date('G'); if (($hora >= 0) AND ($hora < 6)) 
  { 
    $mensaje = "Buena madrugada, identificate"; 
  } 
  else if (($hora >= 6) AND ($hora < 12)) 
  { 
    $mensaje = "Buenos dias, identificate"; 
  } 
  else if (($hora >= 12) AND ($hora < 18)) 
  { 
    $mensaje = "Buenas tardes, identificate"; 
  } 
  else
  { 
  $mensaje = "Buenas noches, identificate"; 
  } 

?>