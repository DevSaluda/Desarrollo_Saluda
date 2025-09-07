# Módulo de Edición de Formas de Pago - SaludaPOS

## Descripción
Este módulo permite editar las formas de pago de los tickets después de la venta, permitiendo configurar múltiples formas de pago como efectivo + tarjeta, efectivo + transferencia, etc.

## Archivos Creados

### 1. Modal de Edición
- **Archivo:** `Modales/EdicionFormasPagoTicket.php`
- **Función:** Interfaz para editar formas de pago de un ticket específico
- **Características:**
  - Validación en tiempo real
  - Soporte para hasta 2 formas de pago
  - Interfaz intuitiva con Bootstrap

### 2. Procesamiento
- **Archivo:** `Consultas/ActualizarFormasPagoTicket.php`
- **Función:** Procesa las actualizaciones de formas de pago
- **Características:**
  - Validaciones de integridad
  - Transacciones de base de datos
  - Logs de auditoría

### 3. Funciones de Utilidad
- **Archivo:** `Consultas/FuncionesFormasPago.php`
- **Función:** Funciones auxiliares para manejo de formas de pago
- **Características:**
  - Parseo de formas de pago
  - Validaciones
  - Estadísticas
  - Exportación a CSV

### 4. JavaScript
- **Archivo:** `js/EdicionFormasPago.js`
- **Función:** Validaciones y funcionalidad del frontend
- **Características:**
  - Validación en tiempo real
  - Manejo de errores
  - Interfaz dinámica

### 5. Reporte
- **Archivo:** `ReporteFormasPago.php`
- **Función:** Reporte de estadísticas de formas de pago
- **Características:**
  - Filtros por fecha y sucursal
  - Gráficos
  - Exportación a CSV

## Cómo Usar

### 1. Acceder al Módulo
1. Ir a **Ventas** en el AdminPOS
2. Buscar el ticket que desea editar
3. Hacer clic en **"Editar Formas de Pago"**

### 2. Editar Formas de Pago
1. Seleccionar la primera forma de pago y su monto
2. Opcionalmente, seleccionar una segunda forma de pago
3. El sistema validará que la suma coincida con el total del ticket
4. Agregar observaciones si es necesario
5. Hacer clic en **"Guardar Cambios"**

### 3. Ver Reportes
1. Ir a **ReporteFormasPago.php**
2. Seleccionar el período y sucursal
3. Hacer clic en **"Generar Reporte"**

## Formas de Pago Soportadas

- **Efectivo**
- **Tarjeta**
- **Transferencia**
- **Cheque**
- **Crédito**
- **Vale**

## Ejemplos de Uso

### Ejemplo 1: Efectivo + Tarjeta
- Ticket total: $200.00
- Efectivo: $150.00
- Tarjeta: $50.00

### Ejemplo 2: Efectivo + Transferencia
- Ticket total: $500.00
- Efectivo: $300.00
- Transferencia: $200.00

## Validaciones

### Automáticas
- La suma de los pagos debe coincidir exactamente con el total del ticket
- Las formas de pago deben ser diferentes
- Los montos deben ser mayores a 0
- Validación en tiempo real

### Manuales
- Observaciones obligatorias para cambios importantes
- Logs de auditoría para trazabilidad

## Estructura de Datos

### Formato de Almacenamiento
```
FormaDePago: "Efectivo:150.00|Tarjeta:50.00"
CantidadPago: 150.00
Pagos_tarjeta: 50.00
```

### Campos Utilizados
- `FormaDePago`: Almacena las formas de pago y montos
- `CantidadPago`: Monto del primer pago
- `Pagos_tarjeta`: Monto del segundo pago

## Integración con Sistema Existente

### Modificaciones Realizadas
1. **EdicionTicketVenta.php**: Agregado botón para editar formas de pago
2. **Sistema de logs**: Integrado con `Logs_Sistema` para auditoría
3. **Reportes**: Compatible con reportes existentes

### Compatibilidad
- ✅ No modifica la estructura de la base de datos
- ✅ Compatible con el sistema actual
- ✅ Mantiene la integridad de los datos
- ✅ Funciona con todos los módulos existentes

## Seguridad

### Validaciones
- Escape de caracteres especiales
- Validación de tipos de datos
- Transacciones de base de datos
- Logs de auditoría

### Permisos
- Requiere sesión activa
- Registra usuario que realiza cambios
- Mantiene trazabilidad completa

## Troubleshooting

### Problemas Comunes

1. **Error: "El total pagado no coincide"**
   - Verificar que la suma de los montos sea exacta
   - Revisar decimales

2. **Error: "Las formas de pago deben ser diferentes"**
   - Seleccionar formas de pago distintas
   - No repetir la misma forma

3. **Modal no se carga**
   - Verificar que el ticket existe
   - Revisar permisos de usuario

### Logs
- Revisar `Logs_Sistema` para auditoría
- Buscar acciones con `EDICION_PAGO`

## Soporte

Para soporte técnico o reportar problemas:
1. Revisar logs del sistema
2. Verificar permisos de usuario
3. Contactar al administrador del sistema

## Versión
- **Versión:** 1.0
- **Fecha:** <?php echo date('Y-m-d'); ?>
- **Compatibilidad:** SaludaPOS v2.0+
