<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'API de Gestión de Artesanos',
    description: 'Documentación oficial de la API para el sistema de gestión de artesanos'
)]
#[OA\Server(
    url: 'http://127.0.0.1:8000',
    description: 'Servidor Local'
)]
class Swagger
{
    // Esta clase solo sirve para contener la configuración de Swagger
}