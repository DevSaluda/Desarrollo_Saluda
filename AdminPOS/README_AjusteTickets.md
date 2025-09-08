# Módulo de Ajuste de Tickets - SaludaPOS

## Descripción
El módulo "Ajuste de Tickets" es una nueva funcionalidad que permite gestionar y editar las formas de pago de los tickets después de la venta. Se encuentra ubicado como submenú dentro del menú principal "Tickets".

## Ubicación en el Menú
```
Tickets
├── Desglose Tickets
├── Desglose Tickets crédito
├── Ajuste de Tickets ← NUEVO MÓDULO
└── Reimpresión de cortes
```

## URL de Acceso
```
https://tu-dominio.com/AdminPOS/AjusteTickets.php
```

## Archivos del Módulo

### Archivos Principales
- **`AjusteTickets.php`** - Página principal del módulo
- **`js/ControlAjusteTickets.js`** - Controlador JavaScript
- **`Consultas/ConsultaAjusteTickets.php`** - Consultas de base de datos
- **`Consultas/ExportarAjusteTickets.php`** - Exportación a Excel

### Modales
- **`Modales/FiltroPorFechasAjuste.php`** - Filtro por rango de fechas
- **`Modales/FiltroPorFormasPagoAjuste.php`** - Filtro por formas de pago
- **`Modales/EdicionFormasPagoTicket.php`** - Modal de edición (ya existente)

## Funcionalidades

### 1. Visualización de Tickets
- Lista de tickets de los últimos 30 días
- Información detallada de cada ticket
- Indicadores visuales para tickets con múltiples formas de pago
- Estadísticas en tiempo real

### 2. Filtros Avanzados
- **Por Sucursal:** Filtrar tickets por sucursal específica
- **Por Fechas:** Rango de fechas personalizable con filtros rápidos
- **Por Formas de Pago:** Múltiples tipos de filtro:
  - Contiene esta forma de pago
  - Solo esta forma de pago
  - Múltiples formas de pago
  - Forma de pago simple

### 3. Acciones por Ticket
- **Ajustar Formas de Pago:** Editar las formas de pago del ticket
- **Ver Desglose:** Mostrar detalle completo del ticket
- **Reimprimir:** Reimprimir el ticket
- **Editar Datos:** Editar información general del ticket

### 4. Exportación
- Exportar datos a Excel
- Incluye todas las formas de pago parseadas
- Formato compatible con Excel

## Características Técnicas

### Base de Datos
- Utiliza la tabla existente `Ventas_POS`
- No modifica la estructura de la base de datos
- Compatible con el sistema actual

### Interfaz
- Diseño responsive con Bootstrap
- DataTables para paginación y búsqueda
- Modales para acciones específicas
- Validaciones en tiempo real

### Seguridad
- Validación de datos en servidor
- Escape de caracteres especiales
- Logs de auditoría para cambios

## Uso del Módulo

### Acceso
1. Ir al menú **Tickets**
2. Seleccionar **Ajuste de Tickets**
3. Se cargará la lista de tickets

### Filtrar Tickets
1. Usar los botones de filtro en la parte superior
2. Seleccionar criterios de filtrado
3. Los resultados se actualizarán automáticamente

### Editar Formas de Pago
1. Buscar el ticket deseado
2. Hacer clic en **Acciones** → **Ajustar Formas de Pago**
3. Configurar las formas de pago en el modal
4. Guardar los cambios

### Exportar Datos
1. Hacer clic en el botón de exportación
2. Se descargará un archivo Excel con los datos

## Filtros Rápidos

### Por Fechas
- **Hoy:** Tickets del día actual
- **Ayer:** Tickets del día anterior
- **Esta Semana:** Tickets de la semana actual
- **Este Mes:** Tickets del mes actual

### Por Formas de Pago
- **Múltiples Pagos:** Tickets con más de una forma de pago
- **Efectivo:** Tickets que incluyen efectivo
- **Tarjeta:** Tickets que incluyen tarjeta
- **Transferencia:** Tickets que incluyen transferencia

## Estadísticas

El módulo muestra estadísticas en tiempo real:
- **Total Tickets:** Número total de tickets
- **Con Múltiples Pagos:** Tickets con múltiples formas de pago
- **Total Vendido:** Suma total de ventas
- **Última Actualización:** Timestamp de la última actualización

## Compatibilidad

### Sistemas Soportados
- ✅ SaludaPOS v2.0+
- ✅ PHP 7.4+
- ✅ MySQL 5.7+
- ✅ Bootstrap 4+
- ✅ jQuery 3+

### Navegadores
- ✅ Chrome 80+
- ✅ Firefox 75+
- ✅ Safari 13+
- ✅ Edge 80+

## Troubleshooting

### Problemas Comunes

1. **No se cargan los tickets**
   - Verificar conexión a base de datos
   - Revisar permisos de usuario
   - Comprobar que existen tickets en el período

2. **Error al filtrar**
   - Verificar que las fechas sean válidas
   - Comprobar que la sucursal existe
   - Revisar logs del servidor

3. **Modal no se abre**
   - Verificar que jQuery esté cargado
   - Comprobar que Bootstrap esté funcionando
   - Revisar la consola del navegador

### Logs
- Revisar `Logs_Sistema` para auditoría
- Buscar acciones con `EDICION_PAGO`
- Verificar errores de PHP en el log del servidor

## Mantenimiento

### Limpieza de Datos
- Los tickets se muestran de los últimos 30 días por defecto
- Se puede ajustar el período en la consulta SQL
- Los filtros permiten acceder a datos históricos

### Actualizaciones
- El módulo se actualiza automáticamente cada 5 minutos
- Se puede forzar actualización con el botón de refresh
- Los cambios se reflejan inmediatamente

## Soporte

Para soporte técnico:
1. Revisar la documentación
2. Verificar logs del sistema
3. Contactar al administrador
4. Reportar problemas con detalles específicos

## Versión
- **Versión:** 1.0
- **Fecha:** <?php echo date('Y-m-d'); ?>
- **Autor:** Sistema SaludaPOS
- **Compatibilidad:** SaludaPOS v2.0+
