<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $table = 'despesas';

    protected $fillable = [
        'deputado_id',
        'tipoDespesa',
        'dataDocumento',
        'fornecedor',
        'valorDocumento'
    ];

    public function deputado(){
        return $this->belongsTo(Deputado::class);
    }
}
