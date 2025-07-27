<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $table = 'despesas';

    protected $fillable = [
        'deputado_id',
        'tipo_despesa',
        'data_documento',
        'fornecedor',
        'valor_documento'
    ];

    public function deputado(){
        return $this->belongsTo(Deputado::class);
    }
}
