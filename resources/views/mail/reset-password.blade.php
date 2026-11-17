@component('mail::message')
# ¡Hola!

Has recibido este correo porque solicitaste restablecer la contraseña para tu cuenta en **Gestión de Artesanos**.

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Restablecer Contraseña
@endcomponent

Este enlace expirará en **60 minutos**.

Si no solicitaste este cambio, puedes ignorar este correo. Tu contraseña actual no se modificará.

Saludos,<br>
**El equipo de Gestión de Artesanos**
@endcomponent
