<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artesano extends Model
{
    use HasFactory;

    protected $table = 'artesanos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'dni',
        'nombres',
        'apellidos',
        'telefono',
        'direccion',
        'especialidad',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'artesano_id');
    }
}