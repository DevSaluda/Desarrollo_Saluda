@echo off
echo Instalando dependencias para el procesamiento de Excel...

REM Crear directorio temp si no existe
if not exist "temp" mkdir temp

REM Instalar PhpSpreadsheet via Composer
echo Instalando PhpSpreadsheet...
composer install --no-dev --optimize-autoloader

echo Instalacion completada!
pause
