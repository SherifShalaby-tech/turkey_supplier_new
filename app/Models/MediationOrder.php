<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediationOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company(){
        return $this->belongsTo('App\Models\Company','company_id');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
