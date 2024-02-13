<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'codigo';
    protected $keyType = 'decimal';
    public $timestamps = false;

    protected $table = 'cliente';

    protected $fillable = [
        'empresa',
        'codigo',
        'razao_social',
        'tipo',
        'cpf_cnpj',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($empresa) {
            $lastRecnum = self::max('recnum');
            $empresa->recnum = $lastRecnum + 1;
        });
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa', 'codigo');
    }
}
