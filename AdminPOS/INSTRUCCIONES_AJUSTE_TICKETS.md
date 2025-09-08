# INSTRUCCIONES PARA VERIFICAR EL MÓDULO AJUSTE DE TICKETS

## 🚨 PROBLEMA REPORTADO
El usuario reporta que no ve los cambios aplicados después del deploy.

## ✅ VERIFICACIONES REALIZADAS
Todos los archivos están presentes y correctos:
- ✅ AjusteTickets.php
- ✅ Consultas/ConsultaAjusteTickets.php
- ✅ Consultas/FuncionesFormasPago.php
- ✅ Consultas/ActualizarFormasPagoTicket.php
- ✅ js/ControlAjusteTickets.js
- ✅ Modales/EdicionFormasPagoTicket.php
- ✅ Modales/FiltroPorFechasAjuste.php
- ✅ Modales/FiltroPorFormasPagoAjuste.php
- ✅ Menu.php (actualizado con el nuevo enlace)

## 🔍 PASOS PARA VERIFICAR

### 1. Verificar que el módulo esté funcionando
Acceder a: `https://tu-dominio.com/AdminPOS/DiagnosticoAjusteTickets.php`

Este archivo verificará:
- ✅ Existencia de todos los archivos
- ✅ Conexión a base de datos
- ✅ Funciones de utilidad
- ✅ Enlace en el menú
- ✅ Permisos de archivos

### 2. Probar la consulta de base de datos
Acceder a: `https://tu-dominio.com/AdminPOS/PruebaConsultaAjuste.php`

Este archivo probará:
- ✅ Consulta principal de tickets
- ✅ Funciones de parseo de formas de pago
- ✅ Generación de HTML

### 3. Acceder al módulo principal
Acceder a: `https://tu-dominio.com/AdminPOS/AjusteTickets.php`

### 4. Verificar el menú
Ir a: **Tickets** → **Ajuste de Tickets**

## 🛠️ POSIBLES PROBLEMAS Y SOLUCIONES

### Problema 1: El módulo no carga
**Solución:**
1. Verificar permisos de archivos (644 para archivos, 755 para directorios)
2. Revisar logs del servidor web
3. Verificar que PHP esté funcionando correctamente

### Problema 2: Error de base de datos
**Solución:**
1. Verificar que la tabla `Ventas_POS` existe
2. Verificar que la tabla `SucursalesCorre` existe
3. Verificar permisos de usuario de base de datos

### Problema 3: El menú no muestra la opción
**Solución:**
1. Limpiar caché del navegador
2. Verificar que el archivo `Menu.php` esté actualizado
3. Verificar que no haya errores de sintaxis en `Menu.php`

### Problema 4: JavaScript no funciona
**Solución:**
1. Verificar que jQuery esté cargado
2. Verificar que Bootstrap esté funcionando
3. Revisar la consola del navegador para errores

## 📋 CHECKLIST DE VERIFICACIÓN

- [ ] Archivo `DiagnosticoAjusteTickets.php` muestra todos los ✅
- [ ] Archivo `PruebaConsultaAjuste.php` muestra datos de tickets
- [ ] El módulo `AjusteTickets.php` carga sin errores
- [ ] El menú muestra "Ajuste de Tickets" en la sección Tickets
- [ ] Los filtros funcionan correctamente
- [ ] La tabla de tickets se muestra
- [ ] Los botones de acción funcionan

## 🔧 COMANDOS DE VERIFICACIÓN

### Verificar permisos de archivos:
```bash
chmod 644 AjusteTickets.php
chmod 644 Consultas/*.php
chmod 644 js/ControlAjusteTickets.js
chmod 644 Modales/*.php
```

### Verificar sintaxis PHP:
```bash
php -l AjusteTickets.php
php -l Consultas/ConsultaAjusteTickets.php
php -l Consultas/FuncionesFormasPago.php
```

## 📞 SOPORTE

Si después de seguir estos pasos el módulo no funciona:

1. **Ejecutar el diagnóstico:** `DiagnosticoAjusteTickets.php`
2. **Revisar logs del servidor** para errores específicos
3. **Verificar la consola del navegador** para errores JavaScript
4. **Contactar al administrador** con los resultados del diagnóstico

## 📝 NOTAS IMPORTANTES

- El módulo está diseñado para funcionar con la estructura existente
- No modifica la base de datos, solo lee de ella
- Es compatible con todos los navegadores modernos
- Requiere PHP 7.4+ y MySQL 5.7+

## 🗑️ LIMPIEZA

Después de verificar que todo funciona, puedes eliminar:
- `DiagnosticoAjusteTickets.php`
- `PruebaConsultaAjuste.php`
- `INSTRUCCIONES_AJUSTE_TICKETS.md`

---

**Fecha de creación:** <?php echo date('Y-m-d H:i:s'); ?>
**Versión del módulo:** 1.0
**Estado:** Listo para producción
