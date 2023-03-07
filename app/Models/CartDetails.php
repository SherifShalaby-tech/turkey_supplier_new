<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetails extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function cart(){
        return $this->belongsTo('App\Models\Cart','cart_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
