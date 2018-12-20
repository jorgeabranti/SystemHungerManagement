<?php

namespace HungerManagement;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
   // protected $fillable = [ 'id_pedido'] ;
    
    public $timestamps = false;
    
    protected $table = 'pedidos';
}
