<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'artesano_id',
        'nombre',
        'descripcion',
        'precio',
        'categoria',
    ];

    public function artesano()
    {
        return $this->belongsTo(Artesano::class, 'artesano_id');
    }
}
