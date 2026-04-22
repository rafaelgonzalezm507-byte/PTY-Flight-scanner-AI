<?php
// Configuración de zona horaria para Panamá
date_default_timezone_set('America/Panama');

// 1. CAPTURA DE DATOS (IP Real y Agente de Usuario)
$ip = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$ua = $_SERVER['HTTP_USER_AGENT'];
$fecha = date("d-m-Y H:i:s");

// 2. REGISTRO EN LOG (Se guarda en un archivo .txt en tu servidor)
$log_entry = "[$fecha] IP: $ip | DISPOSITIVO: $ua" . PHP_EOL;
file_put_contents("accesos_log.txt", $log_entry, FILE_APPEND);

// 3. IDENTIFICACIÓN VISUAL (Sistema y Emojis)
$os = "Sistema Desconocido 🛡️";
if (strpos($ua, 'Android') !== false) $os = "Android Device 📱";
elseif (strpos($ua, 'iPhone') !== false) $os = "iPhone Device 🍏";
elseif (strpos($ua, 'Windows') !== false) $os = "Windows System 💻";
elseif (strpos($ua, 'Linux') !== false) $os = "Linux System 🐧";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOC Dashboard | Rafael González</title>
    <style>
        :root { --neon-blue: #38bdf8; --neon-red: #ef4444; --bg-dark: #020617; }

        body {
            margin: 0; background-color: var(--bg-dark); color: #f8fafc;
            font-family: 'Segoe UI', Roboto, sans-serif;
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; overflow: hidden;
        }

        /* FONTO INTERACTIVO ANIMADO */
        body::before {
            content: ""; position: absolute; width: 200%; height: 200%;
            background-image:
                linear-gradient(rgba(56, 189, 248, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(56, 189, 248, 0.1) 1px, transparent 1px);
            background-size: 40px 40px;
            transform: perspective(500px) rotateX(60deg) translateY(-50%);
            animation: grid-move 12s linear infinite; z-index: -1;
        }
        @keyframes grid-move {
            from { transform: perspective(500px) rotateX(60deg) translateY(0); }
            to { transform: perspective(500px) rotateX(60deg) translateY(40px); }
        }

        /* PANEL PRINCIPAL */
        .soc-panel {
            background: rgba(15, 23, 42, 0.85); border: 2px solid var(--neon-blue);
            padding: 2rem; border-radius: 1rem; width: 90%; max-width: 500px;
            box-shadow: 0 0 40px rgba(56, 189, 248, 0.2); backdrop-filter: blur(8px);
            position: relative;
        }

        /* ALERTA PARPADEANTE */
        .alert-header {
            color: var(--neon-red); font-weight: bold; font-size: 0.8rem;
            text-transform: uppercase; letter-spacing: 2px;
            animation: blink 1s infinite; margin-bottom: 1rem; display: block;
        }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0.2; } }

        h1 {
            color: #fff; font-size: 1.5rem; margin: 0 0 1.5rem 0;
            text-transform: uppercase; border-bottom: 1px solid #1e293b; padding-bottom: 10px;
        }

        .data-row {
            margin: 12px 0; font-family: 'Courier New', monospace; font-size: 0.95rem;
            display: flex; justify-content: space-between; align-items: flex-start;
        }
        .label { color: #64748b; font-weight: bold; }
        .value { color: #f1f5f9; text-align: right; max-width: 70%; word-break: break-all; }

        /* BOX DE ADVERTENCIA */
        .warning-box {
            background: rgba(127, 29, 29, 0.3); border-left: 4px solid var(--neon-red);
            padding: 1rem; border-radius: 4px; color: #fecaca;
            font-size: 0.85rem; margin: 2rem 0; line-height: 1.4;
        }

        /* PIE DE PÁGINA MEJORADO */
        .footer {
            border-top: 1px solid #1e293b; padding-top: 1.5rem; text-align: center;
            color: #94a3b8; font-size: 0.85rem; line-height: 1.6;
        }
        .footer b { color: var(--neon-blue); }
    </style>
</head>
<body>

    <div class="soc-panel">
        <span class="alert-header">⚠️ PROTOCOLO ZERO-CLICK ACTIVADO</span>
        <h1>Auditoría de Sesión</h1>

        <div class="data-row">
            <span class="label">ANALISTA:</span>
            <span class="value">Rafael González 👨‍💻</span>
        </div>
        <div class="data-row">
            <span class="label">TIMESTAMP:</span>
            <span class="value"><?php echo $fecha; ?></span>
        </div>
        <div class="data-row">
            <span class="label">SOURCE_IP:</span>
            <span class="value" style="color: #fbbf24; font-weight: bold;"><?php echo $ip; ?> 📡</span>
        </div>
        <div class="data-row">
            <span class="label">SISTEMA:</span>
            <span class="value"><?php echo $os; ?></span>
        </div>
        <div class="data-row" style="margin-top: 15px;">
            <span class="label">NAV_AGENT:</span>
            <span class="value" style="font-size: 0.7rem; color: var(--neon-blue);"><?php echo $ua; ?></span>
        </div>

        <div class="warning-box">
            🛡️ <strong>AVISO DE SEGURIDAD:</strong> No interactúe con enlaces o scripts externos.
            Su huella digital ha sido capturada en el registro central de auditoría.
        </div>

        <div class="footer">
            <b>Ingeniería en Ciberseguridad</b><br>
            Universidad del Istmo | Panamá 🇵🇦<br>
            Pasantía Profesional - <strong>Istiweb</strong>
        </div>
    </div>

</body>
</html>
