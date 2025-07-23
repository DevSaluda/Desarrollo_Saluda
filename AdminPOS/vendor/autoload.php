<?php

// Autoloader para PhpSpreadsheet
spl_autoload_register(function ($class) {
    // Namespace base para PhpSpreadsheet
    $prefix = 'PhpOffice\\PhpSpreadsheet\\';
    
    // Verificar si la clase pertenece al namespace de PhpSpreadsheet
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Obtener el nombre de la clase relativo al namespace
    $relative_class = substr($class, $len);
    
    // Convertir el namespace a ruta de archivo
    $file = __DIR__ . '/PhpSpreadsheet/' . str_replace('\\', '/', $relative_class) . '.php';
    
    // Si el archivo existe, cargarlo
    if (file_exists($file)) {
        require $file;
    }
});

// También cargar las clases del SpreadsheetReader si es necesario
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
}); 