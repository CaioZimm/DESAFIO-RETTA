<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{
    protected $table = 'deputados';

    protected $fillable = [
        'nome',
        'partido',
        'uf',
        'uri',
        'urlFoto'
    ];

    public function despesas(){
        return $this->hasMany(Despesa::class);
    }
}
