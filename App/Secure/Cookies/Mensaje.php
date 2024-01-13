<?php 
  $hora = date('G'); 
  $saludos = array();
  $serverTime = date('Y-m-d H:i:s');
  echo "Server Time: $serverTime";
  if (($hora >= 0) AND ($hora < 6)) 
  { 
    $saludos = array(
      "¡Buenas vibras en la madrugada! 🌙 ¿Te identificas?",
      "Hola trasnochador, ¡identifícate! 🦉",
      "¡Bienvenido al reino de la madrugada! 🌌 ¿Te identificas?",
      "Despierta guerrero, hoy conquistamos el día. 💪 ¿Te identificas?",
      "¡Ruge en silencio en esta madrugada mágica! 🌠 ¿Te identificas?",
      "¡La madrugada te espera con los brazos abiertos! 🌃 ¿Te identificas?",
      "¿Listo para dominar la madrugada? ¡Identifícate! 🚀",
      "¡Hola valiente nocturno! 🌜 ¿Te identificas?",
      "¡Eleva tu energía en la madrugada! ⚡ ¿Te identificas?",
      "¡Despierta al soñador que llevas dentro! 💭 ¿Te identificas?",
      "¡Aviso nocturno! El éxito nunca duerme, ¿te identificas? 🌌",
      "¡En esta madrugada, vendemos sueños y realizamos metas! 💼 ¿Te identificas?",
      "¡Rumbo al éxito, incluso en la madrugada! 🌄 ¿Te identificas?",
      "¡Vende tu mejor versión en cada amanecer! 🌅 ¿Te identificas?"
    );
  } 
  else if (($hora >= 6) AND ($hora < 12)) 
  { 
    $saludos = array(
      "¡Buenos días, campeón! ☀ ¿Te identificas?",
      "Hola mañanero, ¡identifícate! ☕",
      "¡Despierta, es hora de brillar! 💫 ¿Te identificas?",
      "Que la fuerza del café te acompañe. ☕ ¿Te identificas?",
      "¡Bienvenido al show del día! 🎉 ¿Te identificas?",
      "¡La mañana sonríe cuando tú lo haces! 😊 ¿Te identificas?",
      "¿Preparado para conquistar el día? ¡Identifícate! 🚀",
      "¡Hola maestro del amanecer! 🌄 ¿Te identificas?",
      "¡Que la jornada te sea épica! 🌟 ¿Te identificas?",
      "¡Hoy es tu día para brillar! 💼 ¿Te identificas?",
      "¡En esta mañana, somos arquitectos de nuestro éxito! 🏗️ ¿Te identificas?",
      "¡Vendemos ideas, construimos sueños, y hoy es tu día! 💪 ¿Te identificas?",
      "¡Cada venta es un paso hacia la grandeza! 💼 ¿Te identificas?"
    );
  } 
  else if (($hora >= 12) AND ($hora < 18)) 
  { 
    $saludos = array(
      "¡Buena tarde! 🌞 ¿Te identificas?",
      "Hola luminoso, ¡identifícate! ☀",
      "¡Que tengas una grandiosa tarde! 🌈 ¿Te identificas?",
      "La tarde es joven, ¿listo para la aventura? 🚀 ¿Te identificas?",
      "¡Bienvenido al momento cumbre del día! 🌇 ¿Te identificas?",
      "¡La tarde te invita a brillar con luz propia! 💫 ¿Te identificas?",
      "¿Preparado para destacar en esta tarde espectacular? ¡Identifícate! 🌆",
      "¡Hola rey o reina de la tarde! 👑 ¿Te identificas?",
      "¡Que tu tarde esté llena de éxitos! 💼 ¿Te identificas?",
      "¡A brillar se ha dicho en esta tarde radiante! 🌟 ¿Te identificas?",
      "¡En esta tarde de éxitos, cada venta es un logro! 💼 ¿Te identificas?",
      "¡Vendemos experiencias, cosechamos éxitos! 🌟 ¿Te identificas?",
      "¡Cada paso de venta nos acerca a la grandeza! 💪 ¿Te identificas?"
    );
  } 
  else
  { 
    $saludos = array(
      "¡Buenas noches, soñador! 🌙 ¿Te identificas?",
      "Hola noctámbulo, ¡identifícate! 🌌",
      "¡Que tengas una noche estelar! ✨ ¿Te identificas?",
      "Las estrellas te saludan, ¿preparado para brillar? 🌠 ¿Te identificas?",
      "¡Bienvenido al show nocturno de éxitos! 🎇 ¿Te identificas?",
      "La noche es joven, ¿qué hazañas te depara? 🌙 ¿Te identificas?",
      "¿Listo para conquistar la oscuridad con tu luz? ¡Identifícate! 💡",
      "¡Hola rey o reina de la noche! 👑 ¿Te identificas?",
      "¡Que tu noche esté llena de risas y éxitos! 🌠 ¿Te identificas?",
      "¡Prepárate para soñar alto en esta noche mágica! 🌌 ¿Te identificas?",
      "¡En esta noche de estrellas, cada venta es un destello! 🌟 ¿Te identificas?",
      "¡Vendemos sueños que iluminan la oscuridad! 💭 ¿Te identificas?",
      "¡Cada venta es un paso más hacia la grandeza nocturna! 🚀 ¿Te identificas?"
    );
  }

  $indiceAleatorio = array_rand($saludos);
  $mensaje = $saludos + $serverTime[$indiceAleatorio]  ; 
?>
