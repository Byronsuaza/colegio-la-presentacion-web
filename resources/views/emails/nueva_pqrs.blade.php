<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud PQRS</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px;
            color: #333333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e1e7ec;
        }
        .header {
            background: linear-gradient(135deg, #1b5e8a 0%, #123e5c 100%);
            color: #ffffff;
            padding: 28px 24px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-weight: 700;
        }
        .header p {
            margin: 6px 0 0;
            font-size: 13px;
            color: #d1e5f5;
        }
        .badge-bar {
            background: #f8fafc;
            padding: 12px 24px;
            border-bottom: 1px solid #e9edf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }
        .badge {
            background-color: #c9a96e;
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-block;
        }
        .ticket-no {
            font-weight: 800;
            color: #1b5e8a;
            font-size: 14px;
        }
        .content {
            padding: 24px;
        }
        .section-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #1b5e8a;
            margin: 18px 0 10px;
            border-bottom: 2px solid #eaf1f7;
            padding-bottom: 4px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .info-table td {
            padding: 8px 10px;
            font-size: 14px;
            border-bottom: 1px solid #f1f4f7;
        }
        .info-table td.label {
            width: 38%;
            font-weight: 600;
            color: #55697d;
        }
        .info-table td.value {
            color: #1a202c;
        }
        .message-box {
            background-color: #f8fafc;
            border-left: 4px solid #1b5e8a;
            padding: 16px;
            border-radius: 0 8px 8px 0;
            margin: 12px 0 20px;
            font-size: 14px;
            line-height: 1.6;
            color: #2d3748;
            white-space: pre-wrap;
        }
        .adjunto-notice {
            background-color: #eaf5ff;
            border: 1px dashed #7eb9e6;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 13px;
            color: #1b5e8a;
            margin-bottom: 20px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 28px 0 16px;
        }
        .btn {
            background-color: #1b5e8a;
            color: #ffffff !important;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            display: inline-block;
        }
        .footer {
            background-color: #f8fafc;
            padding: 16px 24px;
            text-align: center;
            font-size: 12px;
            color: #8898aa;
            border-top: 1px solid #e9edf1;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Colegio de La Presentación Neiva</h1>
            <p>Sistema de Gestión de Calidad y Atención al Ciudadano</p>
        </div>

        <!-- Badge & Ticket -->
        <table width="100%" class="badge-bar" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td align="left" style="padding: 12px 24px;">
                    <span class="badge">{{ $submission->tipo }}</span>
                </td>
                <td align="right" style="padding: 12px 24px; text-align: right;">
                    <span class="ticket-no">Radicado #{{ $submission->id }}</span>
                </td>
            </tr>
        </table>

        <!-- Body Content -->
        <div class="content">
            <p style="margin-top: 0; font-size: 14px; line-height: 1.5;">
                Se ha recibido una nueva solicitud a través del formulario oficial de <strong>PQRS</strong> del sitio web institucional.
            </p>

            <div class="section-title">Datos del Solicitante</div>
            <table class="info-table">
                <tr>
                    <td class="label">Nombre completo:</td>
                    <td class="value"><strong>{{ $submission->nombre_completo }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Documento:</td>
                    <td class="value">{{ $submission->tipo_documento }} {{ $submission->documento }}</td>
                </tr>
                <tr>
                    <td class="label">Correo electrónico:</td>
                    <td class="value">
                        <a href="mailto:{{ $submission->email }}" style="color: #1b5e8a; text-decoration: underline;">
                            {{ $submission->email }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="label">Teléfono:</td>
                    <td class="value">{{ $submission->telefono ?? 'No especificado' }}</td>
                </tr>
                <tr>
                    <td class="label">Relación con el colegio:</td>
                    <td class="value">{{ $submission->relacion ?? 'No especificado' }}</td>
                </tr>
                @if(!empty($submission->estudiante_nombre))
                <tr>
                    <td class="label">Estudiante:</td>
                    <td class="value">{{ $submission->estudiante_nombre }} ({{ $submission->estudiante_grado ?? 'Grado no especificado' }})</td>
                </tr>
                @endif
                <tr>
                    <td class="label">Fecha y hora:</td>
                    <td class="value">{{ ($submission->created_at ? $submission->created_at->timezone('America/Bogota') : now()->timezone('America/Bogota'))->format('d/m/Y g:i:s a') }}</td>
                </tr>
            </table>

            <div class="section-title">Detalle de la Solicitud</div>
            <div class="message-box">
{{ $submission->mensaje }}
            </div>

            @if(!empty($submission->adjunto))
            <div class="adjunto-notice">
                📎 <strong>Archivo adjunto:</strong> Se ha anexado el documento cargado por el solicitante a este correo electrónico.
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            Este mensaje fue generado automáticamente por la plataforma web del Colegio de La Presentación de Neiva.<br>
            Puedes responder directamente a este correo para comunicarte con el solicitante.
        </div>
    </div>
</body>
</html>
