<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    
}