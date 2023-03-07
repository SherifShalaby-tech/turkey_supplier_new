<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $table = 'sales_details';
    protected $guarded = [];


    public function sale()
    {
        return $this->belongsTo('App\Models\Sale','sale_id');
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart','cart_id');
    }

}
