<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ config('app.name') }}</title>
</head>
<body style="margin: 0; padding: 0; width: 100%; background-color: #f1f5f9; font-family: 'Segoe UI', Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #f1f5f9; padding: 40px 0;">
        <tr>
            <td align="center">
                <!-- CONTENEDOR PRINCIPAL DEL CORREO -->
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    
                    <!-- CABECERA (HEADER) -->
                    <tr>
                        <td style="background-color: #1e293b; padding: 25px 30px; text-align: center;">
                            <a href="{{ config('app.url') }}" style="text-decoration: none;">
                                <span style="color: #ffffff; font-size: 22px; font-weight: bold; letter-spacing: 1px;">
                                    {{ config('app.name', 'Gestión de Artesanos') }}
                                </span>
                            </a>
                        </td>
                    </tr>

                    <!-- CUERPO DEL MENSAJE (BODY) -->
                    <tr>
                        <td style="padding: 40px 30px; color: #334155; font-size: 16px; line-height: 1.6;">
                            {{ $slot }}
                        </td>
                    </tr>

                    <!-- SUBCOPIA (SUBCOPY - el texto pequeño del final) -->
                    @isset($subcopy)
                        <tr>
                            <td style="padding: 0 30px 30px 30px;">
                                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-top: 1px solid #e2e8f0; padding-top: 20px;">
                                    <tr>
                                        <td style="color: #64748b; font-size: 13px; line-height: 1.5;">
                                            {{ $subcopy }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endisset
                </table>

                <!-- PIE DE PÁGINA (FOOTER) -->
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="max-width: 600px; margin-top: 20px;">
                    <tr>
                        <td style="text-align: center; color: #94a3b8; font-size: 12px;">
                            © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
                            <br>
                            Este es un correo automático, por favor no respondas a este mensaje.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>