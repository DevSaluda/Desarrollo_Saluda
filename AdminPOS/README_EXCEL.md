# Funcionalidad de Carga de Excel para Inventarios

## Descripción
Esta funcionalidad permite cargar inventarios desde un archivo Excel (.xlsx o .xls) directamente en la interfaz de conteo de inventarios.

## Requisitos
- PHP 7.4 o superior
- Composer (para instalar dependencias)
- Librería PhpSpreadsheet

## Instalación

### Windows
1. Ejecutar el archivo `install_dependencies.bat` como administrador
2. O ejecutar manualmente:
   ```cmd
   composer install --no-dev --optimize-autoloader
   ```

### Linux/Mac
1. Ejecutar el archivo `install_dependencies.sh`:
   ```bash
   chmod +x install_dependencies.sh
   ./install_dependencies.sh
   ```
2. O ejecutar manualmente:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

## Formato del Archivo Excel

El archivo Excel debe contener las siguientes columnas:

| Columna | Descripción | Requerido |
|---------|-------------|-----------|
| Clave | Código de barras del producto | Sí |
| Nombre | Nombre del producto | No |
| Stock | Stock actual en el sistema | Sí |
| Conteo fisico | Conteo físico realizado en sucursal | Sí |
| Diferencia | Diferencia entre stock y conteo físico | No (se calcula automáticamente) |
| Observaciones | Comentarios adicionales | No |

## Uso

1. En la interfaz de conteo de inventarios, hacer clic en el botón "Cargar Excel"
2. Seleccionar el archivo Excel
3. Seleccionar el tipo de ajuste, anaquel y repisa
4. Hacer clic en "Vista previa" para verificar los datos
5. Hacer clic en "Cargar datos" para agregar los productos a la tabla

## Archivos Modificados/Creados

- `CuentaInventarios.php` - Agregado botón de carga de Excel
- `Modales/CargarExcelInventario.php` - Modal para carga de Excel
- `Consultas/ProcesarExcelInventario.php` - Procesamiento del archivo Excel
- `composer.json` - Dependencias de PhpSpreadsheet
- `install_dependencies.bat` - Script de instalación para Windows
- `install_dependencies.sh` - Script de instalación para Linux/Mac

## Notas Técnicas

- Los archivos Excel se procesan temporalmente y se eliminan después del procesamiento
- Los productos deben existir en la base de datos para ser cargados
- Si un producto ya existe en la tabla, se suma la cantidad del Excel
- Se valida que las columnas requeridas estén presentes en el archivo
