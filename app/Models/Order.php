<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;
     protected $fillable = [
        'user_id', 'name', 'rec_address', 'phone', 'product_id', 'payment_status'
    ];
     public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    
}