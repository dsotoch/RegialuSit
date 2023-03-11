<x-mail::message>
# Instrucciones

Felicitaciones!...Se ha Generado Correctamente una nueva contraseña : {{$password}}

<x-mail::button :url="'http://localhost:8000/Login/IniciarSesion'">
Confirmar Nueva Contraseña
</x-mail::button>

Muchas Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
