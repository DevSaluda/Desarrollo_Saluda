<?php
// Obtener los datos enviados desde el frontend
$data = json_decode(file_get_contents('php://input'), true);

// Decodificar la imagen base64
$image = $data['image'];
$image = str_replace('data:image/png;base64,', '', $image);
$image = str_replace(' ', '+', $image);
$imageData = base64_decode($image);

// Texto reconocido con OCR
$recognizedText = $data['recognizedText'];

// Guardar la imagen (opcional)
file_put_contents('captura.png', $imageData);

// Enviar una respuesta con el texto reconocido
echo json_encode(["status" => "success", "message" => "Imagen y texto procesados correctamente", "text" => $recognizedText]);
?>
