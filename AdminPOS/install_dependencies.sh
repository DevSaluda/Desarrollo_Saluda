#!/bin/bash

echo "Instalando dependencias para el procesamiento de Excel..."

# Crear directorio temp si no existe
mkdir -p temp

# Instalar PhpSpreadsheet via Composer
echo "Instalando PhpSpreadsheet..."
composer install --no-dev --optimize-autoloader

echo "Instalación completada!"
