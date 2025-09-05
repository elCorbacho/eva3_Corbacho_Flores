<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fecha_inicio', 'estado', 'responsable', 'monto', 'created_by'];
}

