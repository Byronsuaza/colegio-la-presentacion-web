<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Postulación – Trabaja con Nosotros</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 20px; color: #333333; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08); border: 1px solid #e1e7ec; }
        .header { background: linear-gradient(135deg, #1b5e8a 0%, #123e5c 100%); color: #ffffff; padding: 28px 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 20px; letter-spacing: 0.04em; text-transform: uppercase; font-weight: 700; }
        .header p { margin: 6px 0 0; font-size: 13px; color: #d1e5f5; }
        .badge { background-color: #c9a96e; color: #ffffff; padding: 4px 12px; border-radius: 20px; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; }
        .ticket-no { font-weight: 800; color: #1b5e8a; font-size: 14px; }
        .content { padding: 24px; }
        .section-title { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #1b5e8a; margin: 18px 0 10px; border-bottom: 2px solid #eaf1f7; padding-bottom: 4px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        .info-table td { padding: 8px 10px; font-size: 14px; border-bottom: 1px solid #f1f4f7; }
        .info-table td.label { width: 38%; font-weight: 600; color: #55697d; }
        .info-table td.value { color: #1a202c; }
        .adjunto-notice { background-color: #eaf5ff; border: 1px dashed #7eb9e6; padding: 10px 14px; border-radius: 6px; font-size: 13px; color: #1b5e8a; margin-bottom: 20px; }
        .footer { background-color: #f8fafc; padding: 16px 24px; text-align: center; font-size: 12px; color: #8898aa; border-top: 1px solid #e9edf1; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Colegio de La Presentación Neiva</h1>
            <p>Talento Humano · Postulación a Vacantes</p>
        </div>

        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc; border-bottom:1px solid #e9edf1;">
            <tr>
                <td align="left" style="padding: 12px 24px;">
                    <span class="badge">{{ $postulacion->cargo }}</span>
                </td>
                <td align="right" style="padding: 12px 24px; text-align: right;">
                    <span class="ticket-no">Postulación #{{ $postulacion->id }}</span>
                </td>
            </tr>
        </table>

        <div class="content">
            <p style="margin-top: 0; font-size: 14px; line-height: 1.5;">
                Se ha recibido una nueva postulación a través del formulario <strong>Trabaja con Nosotros</strong> del sitio web institucional.
            </p>

            <div class="section-title">Datos del Postulante</div>
            <table class="info-table">
                <tr>
                    <td class="label">Nombre completo:</td>
                    <td class="value"><strong>{{ $postulacion->nombre_completo }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Número de contacto:</td>
                    <td class="value">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $postulacion->telefono) }}" style="color: #1b5e8a;">{{ $postulacion->telefono }}</a>
                    </td>
                </tr>
                <tr>
                    <td class="label">Correo electrónico:</td>
                    <td class="value">
                        <a href="mailto:{{ $postulacion->email }}" style="color: #1b5e8a; text-decoration: underline;">{{ $postulacion->email }}</a>
                    </td>
                </tr>
                <tr>
                    <td class="label">Cargo / vacante:</td>
                    <td class="value">{{ $postulacion->cargo }}</td>
                </tr>
                <tr>
                    <td class="label">Fecha y hora:</td>
                    <td class="value">{{ ($postulacion->created_at ?? now())->timezone('America/Bogota')->format('d/m/Y g:i a') }}</td>
                </tr>
                <tr>
                    <td class="label">Tratamiento de datos:</td>
                    <td class="value">Autorizado por el postulante ✔</td>
                </tr>
            </table>

            <div class="adjunto-notice">
                📎 <strong>Hoja de vida adjunta:</strong> el documento cargado por el postulante viene anexo a este correo.
                También queda disponible en el panel administrativo, sección <strong>Postulaciones</strong>.
            </div>
        </div>

        <div class="footer">
            Este mensaje fue generado automáticamente por la plataforma web del Colegio de La Presentación de Neiva.<br>
            Puedes responder directamente a este correo para comunicarte con el postulante.
        </div>
    </div>
</body>
</html>
