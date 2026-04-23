# ✈️ PTY Flight Scanner AI

Sistema automatizado de monitoreo y visualización de precios de vuelos internacionales desde la Ciudad de Panamá (PTY).

## 🚀 Descripción
Este proyecto es un ecosistema ETL (Extract, Transform, Load) desarrollado durante mi práctica profesional. El sistema automatiza la búsqueda de vuelos económicos utilizando inteligencia de datos y despliega los resultados en un panel web accesible globalmente mediante túneles seguros.

## 🛠️ Stack Tecnológico
- Lenguajes: Python 3.x (Extracción), PHP 8.x (Frontend), Bash (Orquestación).
- Base de Datos: MariaDB / MySQL.
- Integraciones: SerpApi (Google Flights Engine) y Cloudflare Tunnels.

## 📂 Estructura del Proyecto
- agente_inteligente.py: Script principal de extracción y carga en base de datos.
- actualizar_vuelos.sh: Orquestador en Bash para sincronización masiva de destinos.
- index.php: Interfaz de usuario dinámica con blindaje de caracteres (UTF-8) y Bootstrap 5.

## 🔒 Ciberseguridad y Networking
- Exposición Segura: Uso de túneles de Cloudflare para evitar la apertura de puertos locales (Port Forwarding inseguro).
- Protección SQL: Implementación de consultas preparadas (Prepared Statements) para prevenir inyecciones SQL.
- Integridad: Manejo de charsets utf8mb4 para asegurar la integridad de los datos entre la DB y la web.

---
Desarrollado por Rafael Gonzalez - Ingeniería en Ciberseguridad

> Rafael:
​📄 Reporte de Proyecto: Sistema de Monitoreo de Vuelos PTY-Global
​Fecha: 22 de abril de 2026
Desarrollador: Rafael González
Institución: Universidad del Istmo (Práctica Profesional - Istiweb)
Área: Ingeniería en Ciberseguridad
​1. Resumen de la Arquitectura
​Se diseñó un sistema de extracción de datos (ETL) y visualización web que permite monitorear precios de vuelos desde Ciudad de Panamá (PTY) hacia diversos destinos globales. El sistema se divide en tres capas:
​Capa de Extracción (Python + SerpApi): Obtiene datos reales de Google Flights.
​Capa de Persistencia (MariaDB/MySQL): Almacena precios, fechas y enlaces de reserva.
​Capa de Presentación (PHP + Bootstrap + Cloudflare): Interfaz de usuario accesible desde la web.
​2. Componentes Técnicos Desarrollados
​A. Script de Automatización (agente_inteligente.py)
​Es el motor del sistema. Utiliza la API de SerpApi para realizar búsquedas en Google Flights evitando bloqueos por IP (anti-bot).
​Funcionalidad: Recibe un código IATA como argumento (ej. MIA, MAD), consulta el vuelo más económico para julio de 2026 y extrae la "URL larga" de reserva.
​Blindaje de Datos: Se configuró para limpiar registros previos antes de insertar el nuevo, manteniendo la base de datos optimizada.
​Manejo de Errores: Incluye bloques try-except para capturar fallos de red o de API.
​B. Orquestador de Sincronización (actualizar_vuelos.sh)
​Un script en Bash diseñado para ejecutar el agente de Python de forma masiva.
​Alcance: Cubre 18 destinos estratégicos en EE.UU., Europa y Latinoamérica.
​Uso: ./actualizar_vuelos.sh actualiza toda la base de datos en una sola ejecución de terminal.
​C. Interfaz de Usuario (index.php)
​Diseñada con un enfoque profesional y limpio utilizando Bootstrap 5.
​Blindaje Anti-Símbolos: Se implementaron cabeceras UTF-8 y utf8mb4 en la conexión a la DB para permitir el uso de tildes y la letra "ñ" sin errores visuales.
​Lógica de "Match": El PHP busca en la tabla hallazgos_agente utilizando el código IATA seleccionado por el usuario, mostrando el precio más reciente y un botón de reserva directo.
​Seguridad: Uso de Consultas Preparadas (Prepared Statements) para mitigar ataques de Inyección SQL.
​3. Despliegue y Túnel de Red
​Para la fase de pruebas, se utilizó Cloudflare Tunnel (cloudflared) para exponer el servidor local (Kali Linux) a internet de forma segura sin abrir puertos en el router.
​URL Actual de Pruebas: https://harvard-session-eggs-archives.trycloudflare.com/pentesting/
​Beneficio: Permite la visualización externa del progreso del proyecto en tiempo real.
​4. Solución de Problemas Clave (Logros del Día)
​Truncamiento de URLs: Se identificó que las URLs de Google Flights eran demasiado largas para un campo VARCHAR(255). Se corrigió modificando la estructura de la tabla a tipo TEXT, permitiendo enlaces de reserva completos y funcionales.
​Sincronización de Caracteres: Se eliminaron los símbolos de interrogación en palabras como "España" o "Panamá" mediante la configuración correcta de los charsets en PHP y MariaDB.
​Error de Punto de Entrada: Se corrigió el error NameError: name 'name' is not defined asegurando que la sintaxis de Python fuera la estándar de la industria: if name == "main":.
​5. Conclusión y Próximos Pasos
​El sistema es actualmente funcional y estable. El usuario puede seleccionar un destino y obtener el precio más bajo detectado por el agente IA con un enlace de reserva válido.
Agente inteligente de busqueda de vuelos mediante Python, Bash y PHP con despligue en Cloudflare 
