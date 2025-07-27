<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{
    protected $table = 'deputados';

    protected $fillable = [
        'id',
        'nome',
        'partido',
        'uf',
        'uri',
        'urlFoto'
    ];

    public $incrementing = false;

    public function despesas()
    {
        return $this->hasMany(Despesa::class, 'deputado_id', 'id');
    }
}
