<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome', 'email', 'telefone', 'estado', 'cidade', 'nascimento'];

    public function planos()
    {
        return $this->belongsToMany('App\Plano', 'cliente_planos', 'cliente_id', 'plano_id');
    }
}
