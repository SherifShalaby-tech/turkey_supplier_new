<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\Models\Company','company_id');
    }

    public function details(){
        return $this->hasMany('App\Models\CartDetails','cart_id');
    }
}
