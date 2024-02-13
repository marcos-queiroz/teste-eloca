<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'codigo';
    protected $keyType = 'decimal';
    public $timestamps = false;

    protected $table = 'empresa';

    protected $fillable = [
        'codigo',
        'empresa',
        'sigla',
        'razao_social',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($empresa) {
            $lastRecnum = self::max('recnum');
            $empresa->recnum = $lastRecnum + 1;
        });
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'empresa', 'codigo');
    }
}
