<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Planos extends Model
{
    protected $fillable = ['cliente_id', 'plano_id'];
    protected $table = 'cliente_planos';
}
